@extends('components.layout')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 shadow-xl rounded-lg border">
    <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
        📦 {{ $showProduct->name }}
    </h2>

    <div class="grid grid-cols-1 gap-4 text-gray-700">
        <p><strong class="text-gray-900">📖 Beschrijving:</strong> {{ $showProduct->description }}</p>
        <p><strong class="text-gray-900">📂 Categorie:</strong> {{ $showProduct->category }}</p>
        <p><strong class="text-gray-900">🛠️ Materiaal:</strong> {{ $showProduct->material }}</p>
        <p><strong class="text-gray-900">🎯 Complexiteit:</strong> {{ $showProduct->complexity }}</p>
        <p><strong class="text-gray-900">🌱 Duurzaamheid:</strong> {{ $showProduct->durability }}</p>
        <p class="text-green-600 font-semibold text-lg">
            <strong class="text-gray-900">💰 Prijs:</strong> €{{ number_format($showProduct->price, 2) }}
        </p>
    </div>

    <div class="mt-6 flex justify-between items-center">
        <!-- Knop voor terug naar overzicht -->
        <a href="{{ route('products.index') }}" 
           class="text-blue-600 hover:underline font-medium">
            ← Terug naar overzicht
        </a>

        <!-- Knop om product te bewerken -->
        @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->id === $product->user_id))
        <a href="{{ route('products.edit', $showProduct->id) }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition flex items-center">
            ✏️ Bewerken
        </a>
        @endif
    </div>
</div>
@endsection
