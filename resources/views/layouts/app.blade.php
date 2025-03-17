<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    @vite('resources/css/app.css') <!-- Als je Vite gebruikt, anders wijzig dit naar je assets -->
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <header class="bg-blue-500 p-4 text-white">
            <h1 class="text-2xl">Admin Dashboard</h1>
        </header>

        <main>
            @yield('content') <!-- Hier wordt de inhoud van de pagina weergegeven -->
        </main>

        <footer class="bg-gray-800 text-white p-4 text-center">
            &copy; 2025 MakersMarkt
        </footer>
    </div>
</body>
</html>
