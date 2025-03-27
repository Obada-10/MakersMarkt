<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
    <title>Makers Markt!</title>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-6 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/logo.png') }}" 
                    alt="Logo" 
                    class="h-12 w-auto object-contain transition duration-300 hover:scale-105 hover:drop-shadow-md" />
            
                <h1 class="text-4xl font-extrabold text-gray-900">
                    Makers<span class="text-blue-600 shadow-lg transform rotate-[-3deg] inline-block">Markt</span>
                </h1>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" 
                        class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg shadow hover:bg-gray-300 transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="px-5 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                                Log out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                        class="px-5 py-2 text-sm font-medium text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" 
                            class="px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif

        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-cover bg-center h-screen" style="background-image: url('https://images.unsplash.com/photo-1519389950473-47ba0277781c');">
        <div class="flex items-center justify-center h-full bg-black bg-opacity-60">
            <div class="text-center text-white max-w-2xl">
                <h1 class="text-5xl font-bold leading-tight">
                    Welkom bij de <span class="text-blue-400">Makers Markt</span>
                </h1>
                <p class="mt-4 text-lg text-gray-300">
                    Ontdek unieke, handgemaakte producten van creatieve makers.
                </p>
                <a href="{{ route('register') }}" 
                   class="mt-6 inline-block bg-blue-600 text-white py-3 px-6 rounded-lg shadow-lg hover:bg-blue-700 transition">
                    Word een Maker
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold text-gray-800 mb-6">Waarom Makers Markt?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-blue-600">🌟 Unieke Producten</h3>
                    <p class="mt-2 text-gray-600">Exclusieve handgemaakte creaties, direct van de maker.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-blue-600">🛍️ Veilig & Betrouwbaar</h3>
                    <p class="mt-2 text-gray-600">Eenvoudig en veilig winkelen zonder gedoe.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <h3 class="text-xl font-semibold text-blue-600">💡 Steun Makers</h3>
                    <p class="mt-2 text-gray-600">Help onafhankelijke makers groeien door hun werk te kopen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-blue-600">
        <div class="container mx-auto text-center">
            <h3 class="text-4xl font-bold text-white mb-6">Start vandaag nog!</h3>
            <p class="text-lg text-white mb-8">Bekijk onze producten en steun creatieve makers.</p>
            <a href="{{ route('products.index') }}" class="bg-white text-blue-600 font-bold py-3 px-6 rounded-full hover:bg-gray-200 transition">
                Bekijk onze producten
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 py-6">
        <div class="container mx-auto text-center text-gray-400">
            <p>&copy; 2025 Makers Markt. All Rights Reserved.</p>
        </div>
    </footer>

</body>
</html>