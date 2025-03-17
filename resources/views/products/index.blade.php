@extends('component.layouts')

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

    <!-- 🔍 Filtersectie -->
    <form action="{{ route('products.index') }}" method="GET" class="mb-6 bg-white p-6 shadow-md rounded-lg">
        <div class="flex flex-wrap gap-4">
            <select name="category" class="p-3 border rounded-lg w-1/3">
                <option value="">📂 Categorie (alle)</option>
                @foreach ($filterOptions->pluck('category')->unique() as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <select name="material" class="p-3 border rounded-lg w-1/3">
                <option value="">🛠️ Materiaal (alle)</option>
                @foreach ($filterOptions->pluck('material')->unique() as $material)
                    <option value="{{ $material }}" {{ request('material') == $material ? 'selected' : '' }}>
                        {{ $material }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="production_time" placeholder="📆 Max Productietijd (dagen)" 
                   class="p-3 border rounded-lg w-1/3" value="{{ request('production_time') }}">

            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition">
                🔍 Filter
            </button>
        </div>
    </form>

    <!-- 📜 Productenlijst -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <div class="bg-white p-6 rounded-lg shadow-md border hover:shadow-lg transition">
                <h4 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h4>
                <p class="text-gray-500 mt-2">{{ $product->description }}</p>
                <p class="text-green-600 font-bold text-lg mt-3">€{{ number_format($product->price, 2) }}</p>

                <div class="mt-4 flex justify-between items-center">
                    <a href="{{ route('products.show', $product->id)}}" 
                       class="text-blue-500 font-medium hover:underline">🔍 Bekijk</a>

                    @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->id === $product->user_id))
                        <div class="flex space-x-3">
                            <a href="{{route('products.edit', $product->id)}}" 
                               class="text-yellow-500 font-medium hover:underline">✏️ Bewerken</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 font-medium hover:underline">🗑️ Verwijderen</button>
                            </form>
                        </div>
                    @endif  
                </div>
            </div>
        @endforeach
    </div>
@endsection
