@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-xl shadow-2xl max-w-4xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-900">Gebruikersprofiel</h1>

    <!-- Profile Card -->
    <div class="bg-gray-50 p-8 rounded-xl shadow-lg mb-8">
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
            <!-- Profile Picture -->
            @if ($user->profile && $user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile picture" class="w-40 h-40 rounded-full border-4 border-indigo-500 shadow-md">
            @else
                <div class="w-40 h-40 bg-gray-200 rounded-full flex items-center justify-center text-gray-500 font-bold text-lg shadow-md">
                    No Image
                </div>
            @endif

            <!-- User Info -->
            <div class="text-center md:text-left">
                <h2 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h2>
                <p class="text-sm text-gray-600 mt-2">{{ $user->email }}</p>
                <a href="{{ route('admin.users.edit', $user) }}" class="mt-4 inline-block px-6 py-2 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition duration-300 ease-in-out">
                    Bewerk profiel
                </a>
            </div>
        </div>

        <!-- Bio Section -->
        <div class="mt-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Bio</h3>
            <p class="text-gray-700 leading-relaxed">
                {{ $user->profile->bio ?? 'Geen bio beschikbaar' }}
            </p>
        </div>
    </div>

    <!-- Back Button -->
    <a href="{{ route('admin.users.index') }}" class="inline-block px-6 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition duration-300 ease-in-out">
        Terug naar gebruikerslijst
    </a>
</div>
@endsection