<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-900">📊 Dashboard</h2>
            <span class="text-gray-600 text-sm">Welkom terug!</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                <div class="p-8">
                    <h3 class="text-xl font-semibold text-gray-800">✅ Je bent ingelogd!</h3>

                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-700">📦 Productbeheer</h3>
                        <p class="text-gray-500">Beheer je producten via de onderstaande opties:</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                            <a href="{{ route('products.index') }}" 
                               class="flex items-center gap-2 bg-blue-500 text-white p-4 rounded-lg shadow-md hover:bg-blue-600 transition">
                                <span class="text-lg">📋</span>
                                <span class="font-medium">Bekijk alle producten</span>
                            </a>
                            {{-- <a href="{{ route('admin.users') }}" 
                               class="flex items-center gap-2 bg-blue-500 text-white p-4 rounded-lg shadow-md hover:bg-blue-600 transition">
                                <span class="text-lg">📋</span>
                                <span class="font-medium">Bekijk alle users</span>
                            </a> --}}

                            @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->role === 'maker'))
                                    <a href="{{ route('products.create') }}" 
                                    class="flex items-center gap-2 bg-green-500 text-white p-4 rounded-lg shadow-md hover:bg-green-600 transition">
                                    <span class="text-lg">➕</span>
                                    <span class="font-medium">Nieuw product toevoegen</span>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
