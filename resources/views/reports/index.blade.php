@extends('components.layout')

@section('content')
    <h2 class="text-xl font-bold mb-4">Gerapporteerde Producten</h2>
    @if ($products->count() < 3)
        <p>Niks om weer te geven</p>
    @endif
    @foreach ($products as $product)
        <div class="p-4 border rounded-lg mb-4">
            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <p><strong>Rapporten:</strong> {{ $product->reports_count }}</p>

            <div class="flex space-x-2 mt-2">
                <form action="{{ route('reports.approve', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Report afkeuren</button>
                </form>

                <form action="{{ route('reports.delete', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Product verwijderen</button>
                </form>
            </div>
        </div>
    @endforeach

    <a href="{{ route('products.index') }}" class="text-blue-500 mt-4 inline-block">← Terug naar overzicht</a>
@endsection
