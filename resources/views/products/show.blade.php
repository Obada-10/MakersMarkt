@extends('components.layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">{{$showProduct->name }}</h2> 
    <p><strong>Beschrijving:</strong> {{$showProduct->description }}</p>
    <p><strong>Categorie:</strong> {{ $showProduct->category }}</p>
    <p><strong>Materiaal:</strong> {{ $showProduct->material }}</p>
    <p><strong>Complexiteit:</strong> {{$showProduct->complexity }}</p>
    <p><strong>Duurzaamheid:</strong> {{$showProduct->durability }}</p>
    <p><strong>Prijs:</strong> €{{ number_format($showProduct->price, 2) }}</p>


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
