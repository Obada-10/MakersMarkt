@extends('components.layout')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-lg">
        <h3 class="text-2xl font-semibold text-center mb-6">Product toevoegen</h3>

        <form action="{{ route('products.update', $productEdit->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Naam:</label>
                <input type="text" name="name" required class="w-full p-2 border rounded-lg" value="{{$productEdit->name}}">
            </div>

            <div>
                <label class="block font-medium">Beschrijving:</label>
                <textarea name="description" required class="w-full p-2 border rounded-lg">{{$productEdit->description}}</textarea>
            </div>

            <div>
                <label class="block font-medium">Categorie:</label>
                <select name="category" required class="w-full p-2 border rounded-lg">
                    @foreach ($filtersEdit->pluck('category')->unique() as $category)
                        <option value="{{ $category }}" value="{{$productEdit->category}}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Materiaal:</label>
                <select name="material" required class="w-full p-2 border rounded-lg">
                    @foreach ($filtersEdit->pluck('material')->unique() as $material)
                        <option value="{{ $material }}" value="{{$productEdit->material}}">{{ $category }}>{{ $material }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Productietijd (dagen):</label>
                <input type="number" name="production_time" min="1" required class="w-full p-2 border rounded-lg" value="{{$productEdit->production_time}}">
            </div>

            <div>
                <label class="block font-medium">Complexiteit:</label>
                <select name="complexity" required class="w-full p-2 border rounded-lg">
                    @foreach ($filtersEdit->pluck('complexity')->unique() as $complexity)
                        <option value="{{ $complexity }}" value="{{$productEdit->material}}">{{ $complexity }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Duurzaamheid:</label>
                <select name="durability" required class="w-full p-2 border rounded-lg">
                    @foreach ($filtersEdit->pluck('durability')->unique() as $durability)
                        <option value="{{ $durability }}" value="{{$productEdit->durability}}">{{ $durability }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block font-medium">Unieke Eigenschappen (optioneel):</label>
                <textarea name="unique_features" class="w-full p-2 border rounded-lg" value="{{$productEdit->unique_features}}"></textarea>
            </div>

            <div>
                <label class="block font-medium">Prijs (€):</label>
                <input type="number" name="price" step="0.01" required class="w-full p-2 border rounded-lg" value="{{$productEdit->price}}">
            </div>

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600">
                Aanpassen
            </button>

            <a href="{{ route('products.index') }}" class="text-blue-500 mt-4 inline-block">← Terug naar overzicht</a>
        </form>
    </div>
</div>
@endsection
