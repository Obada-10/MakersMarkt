<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

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
        
        // Maak de gebruiker aan
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'koper',  // Rol standaard instellen als 'koper'
        ]);
        
        // Stel een standaard bio in bij het profiel
        $defaultBio = 'This is your default bio.'; // Standaard bio
    
        // Maak een profiel aan voor de gebruiker met een standaard bio
        Profile::create([
            'user_id' => $user->id,
            'name' => $user->name,  // Vul het profiel in met de naam van de gebruiker
            'bio' => $defaultBio,  // Standaard bio
            'profile_picture' => '',  // Leeg of standaard afbeelding
        ]);
    
        // Triggers the Registered event (optioneel, afhankelijk van je toepassing)
        event(new Registered($user));
    
        // Log de gebruiker in
        Auth::login($user);
    
        // Redirect naar dashboard
        return redirect(route('dashboard', absolute: false));
    }
}
