@extends('components.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">📦 Alle producten</h3>

        <div class="flex space-x-4">
            
            <a href="{{ route('orders.basket') }}" class="text-gray-800 font-medium hover:underline relative">
                🛒 Winkel-Mandje
                <!-- Aantal bestellingen in een rode badge boven de winkelmandje-icoon -->
                <span class="absolute top-[-10px] right-[-10px] bg-red-500 text-white rounded-full text-xs w-5 h-5 flex items-center justify-center">
                    {{ $orderCount }}
                </span>
            </a>

            <a href="{{ route('orders.bestelling') }}" class="text-gray-800 font-medium hover:underline relative">
                📦 Mijn Bestellingen
            </a>
            
            @if(auth()->check())
                <a href="{{ route('dashboard') }}" class="text-red-500 font-medium hover:underline">🏠 Dashboard</a>
            @endif
            @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->role === 'maker'))
                <a href="{{ route('products.create') }}" 
                   class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-600 transition">
                    ➕ Product toevoegen
                </a>
            @endif
        </div>
    </div>

    <form action="{{ route('products.index') }}" method="GET" class="mb-4 flex flex-wrap gap-4">
        <select name="category" class="p-2 border rounded-lg">
            <option value="">Categorie (alle)</option>
            @foreach ($filterOptions->pluck('category')->unique() as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
    
        <select name="material" class="p-2 border rounded-lg">
            <option value="">Materiaal (alle)</option>
            @foreach ($filterOptions->pluck('material')->unique() as $material)
                <option value="{{ $material }}" {{ request('material') == $material ? 'selected' : '' }}>
                    {{ $material }}
                </option>
            @endforeach
        </select>

        <input type="number" name="production_time" placeholder="Max Productietijd (dagen)" class="p-2 border rounded-lg"
        value="{{ request('production_time') }}">

        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Filter</button>
    </form>    

    <ul>
        @foreach ($products as $product)
            <li class="flex items-center justify-between p-4 border-b">
                <div>
                    <a href="{{ route('products.show', $product->id)}}" class="text-lg font-bold text-gray-800 hover:underline">{{ $product->name }}</a><br>
                    <span class="text-gray-600">{{ $product->description }}</span><br>
                    <span class="text-green-600 font-bold text-lg">€{{ number_format($product->price, 2) }}</span><br>

                    <!-- Gemiddelde beoordeling en sterren -->
                    <div class="rating flex items-center mt-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star {{ $i <= $product->average_rating ? 'text-yellow-500' : 'text-gray-300' }} text-xl">★</span>
                        @endfor
                        <span class="ml-2">Gemiddeld: {{ $product->average_rating }} / 5</span>
                        <span class="ml-4 text-sm text-gray-600">({{ $product->reviews()->count() }} reviews)</span>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->id === $product->user_id))
                        <a href="{{route('products.edit', $product->id)}}" class="text-blue-500 hover:underline">Aanpassen</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Verwijderen?')" class="text-red-500 hover:underline">Verwijderen</button>
                        </form>
                    @endif  
                    
                    @if ($product->reports()->where('user_id', auth()->id())->exists())
                        <p class="text-red-600 font-bold">Gerapporteerd</p>
                    @else
                        <form action="{{ route('reports.store', $product->id) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Product reportern?')" class="text-red-800 font-bold hover:underline">Report</button>
                        </form> 
                    @endif  

                    <form action="{{ route('orders.basket') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 transition transform hover:scale-105">+ Bestel</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
