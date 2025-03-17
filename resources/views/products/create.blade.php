@extends('components.layout')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="bg-white shadow-xl rounded-lg p-8 w-full max-w-lg border">
        <h3 class="text-3xl font-bold text-gray-800 text-center mb-6">➕ Product toevoegen</h3>

        <form action="{{ route('products.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-gray-700 font-medium mb-1">📛 Naam:</label>
                <input type="text" name="name" required 
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">📖 Beschrijving:</label>
                <textarea name="description" required 
                          class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">📂 Categorie:</label>
                <select name="category" required 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach ($filters->pluck('category')->unique() as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">🛠️ Materiaal:</label>
                <select name="material" required 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach ($filters->pluck('material')->unique() as $material)
                        <option value="{{ $material }}">{{ $material }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">⏳ Productietijd (dagen):</label>
                <input type="number" name="production_time" min="1" required 
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">🎯 Complexiteit:</label>
                <select name="complexity" required 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach ($filters->pluck('complexity')->unique() as $complexity)
                        <option value="{{ $complexity }}">{{ $complexity }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">🌱 Duurzaamheid:</label>
                <select name="durability" required 
                        class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                    @foreach ($filters->pluck('durability')->unique() as $durability)
                        <option value="{{ $durability }}">{{ $durability }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">✨ Unieke Eigenschappen (optioneel):</label>
                <textarea name="unique_features" 
                          class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">💰 Prijs (€):</label>
                <input type="number" name="price" step="0.01" required 
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <button type="submit" 
                    class="w-full bg-blue-500 text-white p-3 rounded-lg hover:bg-blue-600 transition">
                ✔ Opslaan
            </button>

            <a href="{{ route('products.index') }}" 
               class="block text-center text-blue-600 hover:underline mt-4">
                ← Terug naar overzicht
            </a>
        </form>
    </div>
</div>
@endsection
