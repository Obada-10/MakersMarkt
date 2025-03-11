<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
</head>
<body>
    <h2>Registreren</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <label for="name">Naam:</label>
        <input type="text" name="name" required>
        @error('name') <p style="color:red;">{{ $message }}</p> @enderror

        <label for="username">Gebruikersnaam:</label>
        <input type="text" name="name" required>
        @error('username') <p style="color:red;">{{ $message }}</p> @enderror

        <label for="email">E-mail:</label>
        <input type="email" name="email" required>
        @error('email') <p style="color:red;">{{ $message }}</p> @enderror

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror

        <label for="password_confirmation">Bevestig Wachtwoord:</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Registreren</button>
    </form>
</body>
</html>