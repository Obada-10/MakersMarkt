<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold">Productbeheer</h3>
                        <ul class="mt-2 space-y-2">
                            <li>
                                <a href="{{ route('products.index') }}" 
                                   class="block bg-blue-500 text-white p-3 rounded-md hover:bg-blue-600 transition">
                                    📦 Bekijk alle producten
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('products.create') }}" 
                                   class="block bg-green-500 text-white p-3 rounded-md hover:bg-green-600 transition">
                                    ➕ Nieuw product toevoegen
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
