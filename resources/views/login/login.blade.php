<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">E-mail:</label>
        <input type="email" name="email" required>
        @error('email') <p style="color:red;">{{ $message }}</p> @enderror

        <label for="password">Wachtwoord:</label>
        <input type="password" name="password" required>
        @error('password') <p style="color:red;">{{ $message }}</p> @enderror

        <button type="submit">Inloggen</button>
    </form>
</body>
</html>