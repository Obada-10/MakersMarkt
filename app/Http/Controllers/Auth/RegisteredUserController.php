<?php

namespace App\Http\Controllers\Auth;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Maak een gebruiker aan met de standaard rol 'koper'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'koper', // Standaard rol is 'koper'
        ]);

        // Maak het profiel aan met de juiste gegevens
        Profile::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'bio' => 'Ik ben een koper en zoek unieke producten.', // Standaard bio voor koper
            'profile_picture' => 'default_koper.jpg', // Standaard profielfoto voor koper
        ]);

        event(new Registered($user));

        // Log de gebruiker in
        Auth::login($user);

        // Redirect naar de dashboard
        return redirect(route('dashboard', absolute: false));
    }
}