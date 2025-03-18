<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Dashboard Card -->
            <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
                <div class="p-8">
                    <!-- Welcome Message -->
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-bold text-gray-800">👋 Welkom terug, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-500 mt-2">Je bent succesvol ingelogd op Makers Markt.</p>
                    </div>

                    <!-- Product Management Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">📦 Productbeheer</h3>
                        <p class="text-gray-500 mb-6">Beheer je producten of bekijk alle beschikbare opties:</p>

                        <!-- Action Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- View All Products -->
                            <a href="{{ route('products.index') }}" 
                               class="flex flex-col items-center justify-center bg-white p-6 rounded-lg border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all duration-300">
                                <span class="text-3xl mb-4">📋</span>
                                <span class="text-lg font-medium text-gray-800">Bekijk alle producten</span>
                                <p class="text-sm text-gray-500 mt-2 text-center">Ontdek alle producten op Makers Markt.</p>
                            </a>

                            <!-- View All Users (Moderator Only) -->
                            @if(auth()->check() && auth()->user()->role === 'moderator')
                                <a href="{{ route('admin.users.index') }}" 
                                   class="flex flex-col items-center justify-center bg-white p-6 rounded-lg border border-gray-200 hover:border-purple-500 hover:shadow-lg transition-all duration-300">
                                    <span class="text-3xl mb-4">👥</span>
                                    <span class="text-lg font-medium text-gray-800">Bekijk alle gebruikers</span>
                                    <p class="text-sm text-gray-500 mt-2 text-center">Beheer gebruikersaccounts.</p>
                                </a>
                            @endif

                            <!-- Add New Product (Moderator or Maker) -->
                            @if(auth()->check() && (auth()->user()->role === 'moderator' || auth()->user()->role === 'maker'))
                                <a href="{{ route('products.create') }}" 
                                   class="flex flex-col items-center justify-center bg-white p-6 rounded-lg border border-gray-200 hover:border-green-500 hover:shadow-lg transition-all duration-300">
                                    <span class="text-3xl mb-4">➕</span>
                                    <span class="text-lg font-medium text-gray-800">Nieuw product toevoegen</span>
                                    <p class="text-sm text-gray-500 mt-2 text-center">Voeg een nieuw product toe aan de markt.</p>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>