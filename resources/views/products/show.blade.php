@extends('component.layouts')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">{{$showProduct->name }}</h2> 
    <p><strong>Beschrijving:</strong> {{$showProduct->description }}</p>
    <p><strong>Categorie:</strong> {{ $showProduct->category }}</p>
    <p><strong>Materiaal:</strong> {{ $showProduct->material }}</p>
    <p><strong>Complexiteit:</strong> {{$showProduct->complexity }}</p>
    <p><strong>Duurzaamheid:</strong> {{$showProduct->durability }}</p>
    <p><strong>Prijs:</strong> €{{ number_format($showProduct->price, 2) }}</p>

    <a href="{{ route('products.index') }}" class="text-blue-500 mt-4 inline-block">← Terug naar overzicht</a>
</div>
@endsection
