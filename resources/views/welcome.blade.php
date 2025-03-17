<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <div class="min-h-screen flex flex-col justify-between">

            <!-- Navbar -->
            @include('layouts.navigation')

            <!-- Hero Section -->
            <section class="relative bg-gradient-to-r from-blue-500 to-indigo-600 text-white py-20 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto text-center">
                    <h1 class="text-5xl font-bold leading-tight sm:text-6xl">Welkom bij onze webshop!</h1>
                    <p class="mt-4 text-lg sm:text-xl">Ontdek de beste producten tegen de beste prijzen. Alles wat je nodig hebt, op één plek.</p>
                    
                    <!-- Call-to-Action Button -->
                    <div class="mt-8">
                        <a href="{{ route('products.index') }}" class="bg-yellow-500 text-gray-800 px-8 py-3 text-lg font-semibold rounded-full hover:bg-yellow-400 transition duration-300">
                            Bekijk onze producten
                        </a>
                    </div>
                </div>
            </section>

            <!-- Feature Section -->
            <section class="bg-white py-20 px-4 sm:px-6 lg:px-8">
                <div class="max-w-7xl mx-auto text-center">
                    <h2 class="text-4xl font-semibold text-gray-800">Waarom kiezen voor ons?</h2>
                    <p class="mt-4 text-lg text-gray-600">We bieden een breed scala aan producten van hoge kwaliteit, snelle levering en uitstekende klantenservice.</p>
                    
                    <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                        <!-- Feature 1 -->
                        <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-semibold text-gray-800">Breed assortiment</h3>
                            <p class="mt-4 text-gray-600">Van elektronica tot meubels, we hebben het allemaal. Onze producten zijn zorgvuldig geselecteerd om aan jouw behoeften te voldoen.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-semibold text-gray-800">Snelle levering</h3>
                            <p class="mt-4 text-gray-600">We zorgen ervoor dat je bestelling snel en veilig bij je thuis wordt afgeleverd. Je hoeft nooit lang te wachten!</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-gray-100 p-8 rounded-lg shadow-lg">
                            <h3 class="text-2xl font-semibold text-gray-800">Klantenservice</h3>
                            <p class="mt-4 text-gray-600">Onze klantenservice is altijd beschikbaar om je te helpen met al je vragen en problemen. We zorgen voor een geweldige ervaring.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <footer class="bg-gray-800 text-white py-8">
                <div class="max-w-7xl mx-auto text-center">
                    <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Alle rechten voorbehouden.</p>
                    <p>Gemaakt door jouw team.</p>
                </div>
            </footer>
        </div>

    </body>
</html>
