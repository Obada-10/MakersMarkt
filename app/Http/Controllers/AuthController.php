<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Methode om het registratieformulier weer te geven
    public function showRegisterForm()
    {
        // Zorg ervoor dat de gebruiker niet ingelogd is voordat ze zich kunnen registreren
        if (Auth::check()) {
            return redirect('/dashboard'); // Redirect naar dashboard als ingelogd
        }

        return view('register.register'); // Laad de registratie view
    }

    // Methode om de gebruiker te registreren
    public function register(Request $request)
    {
        // Validatie van het registratieformulier
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users', // Zorg ervoor dat username wordt gevalideerd
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Maak een nieuwe gebruiker aan
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username, // Voeg username toe
            'email' => $request->email,
            'password' => Hash::make($request->password), // Versleutel het wachtwoord
        ]);

        // Log de gebruiker automatisch in
        Auth::login($user);

        // Redirect naar het dashboard
        return redirect('/dashboard');
    }

    // Methode om het loginformulier weer te geven
    public function showLoginForm()
    {
        // Zorg ervoor dat de gebruiker niet ingelogd is voordat ze kunnen inloggen
        if (Auth::check()) {
            return redirect('/dashboard'); // Redirect naar dashboard als ingelogd
        }

        return view('login.login'); // Laad de login view
    }

    // Methode om in te loggen
    public function login(Request $request)
    {
        // Valideer de logingegevens
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Probeer de gebruiker in te loggen
        if (Auth::attempt($credentials)) {
            // Redirect naar het dashboard als de inloggegevens correct zijn
            return redirect('/dashboard');
        }

        // Toon een foutmelding als de inloggegevens niet kloppen
        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
        ]);
    }

    // Methode om uit te loggen
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login'); // Redirect naar login pagina na uitloggen
    }
}
