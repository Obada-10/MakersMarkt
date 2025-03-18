<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Profiel bewerken formulier -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Naam -->
                    <div class="block mb-4">
                        <label for="name" class="text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $profile->name ?? '') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        @error('name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div class="block mb-4">
                        <label for="bio" class="text-sm font-medium text-gray-700">{{ __('Bio') }}</label>
                        <textarea name="bio" id="bio" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('bio', $profile->bio ?? '') }}</textarea>
                        @error('bio')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Profielfoto -->
                    <div class="block mb-4">
                        <label for="profile_picture" class="text-sm font-medium text-gray-700">{{ __('Profile Picture') }}</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                        @error('profile_picture')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror

                        @if ($profile && $profile->profile_picture)
                            <div class="mt-4">
                                <p>{{ __('Current Profile Picture:') }}</p>
                                <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" class="mt-2 w-20 h-20 rounded-full">
                            </div>
                        @endif
                    </div>

                    <!-- Update knop -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="ml-4 bg-indigo-500 text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
