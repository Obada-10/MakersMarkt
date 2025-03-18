<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Makers Markt</title>

    <!-- Fonts & Tailwind -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animaties */
        .fade-in {
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .fade-in.show {
            opacity: 1;
            transform: translateY(0);
        }

        .button-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .button-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Zorgt ervoor dat de fade-in effecten starten na laden van de pagina
            document.querySelectorAll(".fade-in").forEach(el => {
                el.classList.add("show");
            });
        });
    </script>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    <div class="relative min-h-screen flex flex-col items-center justify-center px-6">
        
        <!-- Top Navigation (Login/Register) -->
        <header class="absolute top-6 right-6 fade-in">
            @if (Route::has('login'))
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                           class="px-5 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-lg shadow button-hover">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           class="px-5 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 button-hover">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                               class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 button-hover">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <section class="text-center max-w-2xl fade-in">
            <h1 class="text-5xl font-bold leading-tight">
                Welkom bij de <span class="text-blue-500">Makers Markt</span>
            </h1>
            <p class="mt-4 text-lg text-gray-700 dark:text-gray-300">
                Een plek voor creatieve makers om hun werk te tonen en te verkopen.  
                Ontdek handgemaakte en unieke producten van getalenteerde makers.
            </p>
            <a href="{{ route('register') }}" 
               class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-blue-700 button-hover">
                Word een Maker
            </a>
        </section>

        <!-- Extra Info Section -->
        <section class="mt-16 grid md:grid-cols-3 gap-8 text-center max-w-4xl fade-in">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md card-hover">
                <h3 class="text-xl font-semibold">🌟 Unieke Producten</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Handgemaakte en originele creaties, direct van de maker.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md card-hover">
                <h3 class="text-xl font-semibold">🛍️ Veilig & Betrouwbaar</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Eenvoudige en veilige aankopen, zonder gedoe.</p>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md card-hover">
                <h3 class="text-xl font-semibold">💡 Steun Makers</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Help onafhankelijke makers groeien door hun werk te kopen.</p>
            </div>
        </section>
    </div>
</body>
</html>
