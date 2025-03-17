@extends('components.layout')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800">📦 Alle producten</h3>

        <div class="flex space-x-4">
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
    {{-- {{ dd($products) }} --}}

    <ul>
        @foreach ($products as $product)
            <li>
                <a href="{{ route('products.show', $product->id)}}"><strong>{{ $product->name }}</strong><br></a>
                {{ $product->description }}<br>
                <span style="color: green; font-weight: bold;">€{{ number_format($product->price, 2) }}</span><br>

                @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->id === $product->user_id))
                    <a href="{{route('products.edit', $product->id)}}" class="text-blue-500 hover:underline">Aanpassen</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Verwijderen?')" class="text-red-500 hover:underline">Verwijderen</button>
                    </form>
                @endif  
                
                @if ($product->reports()->where('user_id', auth()->id())->exists())
                    <p>Product geroporteerd</p>
                @else
                    <form action="{{ route('reports.store', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" onclick="return confirm('Product reportern?')" class="text-red-800 font-bold hover:underline">
                        |    Report
                        </button>
                    </form> 
                @endif  
                     
            </li>
            <hr>
        @endforeach
    </ul>
@endsection
