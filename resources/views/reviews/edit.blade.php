@extends('components.layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-semibold mb-4">Bewerk je Review</h2>

    <form action="{{ route('reviews.update', $review) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-700">Beoordeling (1-5)</label>
            <input type="number" id="rating" name="rating" min="1" max="5" value="{{ old('rating', $review->rating) }}" class="mt-1 p-2 border rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">Opmerking</label>
            <textarea id="comment" name="comment" rows="4" class="mt-1 p-2 border rounded w-full">{{ old('comment', $review->comment) }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Review bijwerken</button>
    </form>
</div>
@endsection
