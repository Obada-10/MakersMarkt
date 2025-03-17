@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg max-w-3xl">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Gebruiker Bewerken: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label for="name" class="block text-lg font-medium text-gray-700 mb-2">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out" 
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="block text-lg font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out" 
                required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="role" class="block text-lg font-medium text-gray-700 mb-2">Rol</label>
            <select name="role" id="role" 
                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out" 
                required>
                <option value="koper" {{ $user->role == 'koper' ? 'selected' : '' }}>Koper</option>
                <option value="maker" {{ $user->role == 'maker' ? 'selected' : '' }}>Maker</option>
                <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Check of profiel bestaat voordat we proberen de afbeelding te tonen -->
        <div class="mb-6">
            @if ($user->profile)
                @if ($user->profile->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile picture" class="w-32 h-32 rounded-full mt-4">
                @else
                    <p class="text-gray-500 text-sm mt-2">Geen profielfoto beschikbaar.</p>
                @endif
            @else
                <p class="text-gray-500 text-sm mt-2">Geen profiel gevonden voor deze gebruiker.</p>
            @endif
        </div>

        <div class="mb-6">
            <button type="submit" 
                class="w-full py-3 px-4 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                style="display: block; visibility: visible;">
                Bijwerken
            </button>
        </div>
    </form>
</div>
@endsection
