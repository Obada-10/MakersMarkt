@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-xl shadow-2xl max-w-4xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-900">Gebruiker Bewerken: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Naam -->
        <div class="mb-8">
            <label for="name" class="block text-lg font-medium text-gray-700 mb-3">Naam</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                required>
            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-8">
            <label for="email" class="block text-lg font-medium text-gray-700 mb-3">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                required>
            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Rol -->
        <div class="mb-8">
            <label for="role" class="block text-lg font-medium text-gray-700 mb-3">Rol</label>
            <select name="role" id="role" 
                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-300 ease-in-out" 
                required>
                <option value="koper" {{ $user->role == 'koper' ? 'selected' : '' }}>Koper</option>
                <option value="maker" {{ $user->role == 'maker' ? 'selected' : '' }}>Maker</option>
                <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Profielfoto -->
        <div class="mb-8">
            <label class="block text-lg font-medium text-gray-700 mb-3">Profielfoto</label>
            @if ($user->profile && $user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile picture" class="w-32 h-32 rounded-full shadow-md">
            @else
                <p class="text-gray-500 text-sm">Geen profielfoto beschikbaar.</p>
            @endif
        </div>

        <!-- Bijwerken Knop -->
        <div class="mb-8">
            <button type="submit" 
                class="w-full py-3 px-6 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                Bijwerken
            </button>
        </div>
    </form>
</div>
@endsection