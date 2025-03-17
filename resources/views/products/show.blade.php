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

    <div class="mt-6">
        <h3 class="text-xl font-semibold mb-4">Beoordelingen</h3>
        
        <!-- Toon bestaande reviews -->
        @foreach($showProduct->reviews as $review)
            <div class="mb-4 p-4 border rounded-lg">
                <strong>{{ $review->user->name }}</strong> (Rating: {{ $review->rating }}/5)
                <p>{{ $review->comment }}</p>
                
                @if(auth()->check() && auth()->user()->id === $review->user_id)
                    <!-- Review bewerken -->
                    <a href="{{ route('reviews.edit', $review) }}" class="text-blue-600 hover:underline">Bewerk review</a>
                @endif

                @if(auth()->check() && (auth()->user()->id === $review->user_id || auth()->user()->role === 'moderator'))
                    <!-- Review verwijderen -->
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Verwijder review</button>
                    </form>
                @endif
            </div>
        @endforeach

        <!-- Review toevoegen -->
        @auth
            @if(auth()->user()->role === 'koper')
                <h4 class="text-lg font-semibold mt-6">Laat een beoordeling achter:</h4>
                <form action="{{ route('reviews.store', $showProduct) }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Beoordeling (1-5)</label>
                        <input type="number" id="rating" name="rating" min="1" max="5" class="mt-1 p-2 border rounded w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Opmerking</label>
                        <textarea id="comment" name="comment" rows="4" class="mt-1 p-2 border rounded w-full"></textarea>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Review toevoegen</button>
                </form>
            @else
                <p class="mt-4 text-gray-600">Je moet een koper zijn om een review te plaatsen.</p>
            @endif
        @else
            <p class="mt-4 text-gray-600">Je moet ingelogd zijn om een review te plaatsen.</p>
        @endauth
    </div>

    <div class="mt-6 flex justify-between items-center">
        <!-- Knop voor terug naar overzicht -->
        <a href="{{ route('products.index') }}" 
           class="text-blue-600 hover:underline font-medium">
            ← Terug naar overzicht
        </a>

        <!-- Knop om product te bewerken -->
        @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->id === $showProduct->user_id))
        <a href="{{ route('products.edit', $showProduct->id) }}" 
           class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition flex items-center">
            ✏️ Bewerken
        </a>
        @endif
    </div>
</div>
@endsection
