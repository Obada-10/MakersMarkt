@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg max-w-3xl">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Gebruikersprofiel</h1>

    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
        <div class="flex items-center space-x-6">
            @if ($user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile picture" class="w-32 h-32 rounded-full border-4 border-indigo-500">
            @else
                <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold">No Image</div>
            @endif

            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
                <p class="text-sm text-gray-600">{{ $user->email }}</p>
                <a href="{{ route('admin.users.edit', $user) }}" class="text-green-600 hover:text-green-800 transition duration-300">Bewerk profiel</a>
            </div>
        </div>

        <p class="mt-4 text-gray-700">{{ $user->profile->bio ?? 'Geen bio beschikbaar' }}</p>
    </div>

    <a href="{{ route('admin.users.index') }}" class="text-blue-500 hover:text-blue-700 transition duration-300">Terug naar gebruikerslijst</a>
</div>
@endsection
