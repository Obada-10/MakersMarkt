<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Profielinformatie tonen --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h1 class="text-2xl font-semibold mb-4">Profiel van {{ $user->name }}</h1>

                {{-- Controleer of profiel bestaat --}}
                @php
                    $profile = optional($user->profile);
                @endphp

                <p><strong>Naam:</strong> {{ $profile->name ?? 'Geen naam beschikbaar' }}</p>
                <p><strong>Bio:</strong> {{ $profile->bio ?? 'Geen bio beschikbaar' }}</p>

                @if($profile->profile_picture)
                    <div class="mt-4">
                        <p><strong>Profielfoto:</strong></p>
                        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profielfoto" class="w-32 h-32 rounded-full border">
                    </div>
                @else
                    <p>Geen profielfoto geüpload.</p>
                @endif
            </div>

            {{-- Formulier voor profielgegevens bijwerken --}}
<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <h2 class="text-xl font-semibold mb-4">Bewerk je profiel</h2>

    <!-- Foutmeldingen bovenaan -->
    @if($errors->any())
        <div class="mb-4">
            <ul class="list-disc pl-5 text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulier voor profielgegevens -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Naam -->
        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Nickname</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="border rounded-md w-full p-2">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Bio -->
        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Bio</label>
            <textarea name="bio" class="border rounded-md w-full p-2" rows="3">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            @error('bio')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Profielfoto -->
        <div class="mb-4">
            <label class="block font-medium text-sm text-gray-700">Profielfoto</label>
            <!-- Als de profielfoto al bestaat, toon die -->
            @if($user->profile && $user->profile->profile_picture)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profielfoto" class="w-32 h-32 rounded-full">
                </div>
            @endif
            <!-- File uploaden voor nieuwe foto -->
            <input type="file" name="profile_picture" class="border rounded-md w-full p-2">
            @error('profile_picture')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Opslaan knop -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Opslaan</button>
        </div>
    </form>
</div>

            {{-- Wachtwoord wijzigen --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Account verwijderen --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
