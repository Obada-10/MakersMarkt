<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welkom, {{ $user->name }}!</h1>
    <p>Je bent succesvol ingelogd op je dashboard.</p>

    @if($profile)
        <h2>Jouw profielgegevens:</h2>
        <p><strong>Naam:</strong> {{ $profile->name }}</p>
        <p><strong>Bio:</strong> {{ $profile->bio ?? 'Geen bio beschikbaar' }}</p>
        
        @if($profile->profile_picture)
            <p><strong>Profielfoto:</strong></p>
            <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profielfoto" width="150">
        @else
            <p>Geen profielfoto geüpload.</p>
        @endif
    @else
        <p>Je hebt nog geen profielgegevens.</p>
    @endif

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Uitloggen</button>
    </form>
</body>
</html>