<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Toon het profiel bewerk formulier.
     */
    public function edit(Request $request): View
    {
        // Haal het profiel van de ingelogde gebruiker op
        $profile = $request->user()->profile;

        // Als er geen profiel bestaat, maak er dan een aan
        if (!$profile) {
            $profile = Profile::create([
                'user_id' => $request->user()->id,
                'name' => $request->user()->name, // Je kunt hier ook andere standaard waarden instellen
                'bio' => '',
                'profile_picture' => '',
            ]);
        }

        return view('profile.edit', [
            'profile' => $profile,
        ]);
    }

    /**
     * Werk de profielinformatie van de gebruiker bij.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Haal het profiel van de ingelogde gebruiker op
        $profile = $request->user()->profile;

        // Als er geen profiel is, maak het profiel aan
        if (!$profile) {
            $profile = Profile::create([
                'user_id' => $request->user()->id,
                'name' => $request->user()->name,
                'bio' => '',  // Standaard bio
                'profile_picture' => '',  // Standaard profiel foto
            ]);
        }

        // Vul het profiel met de nieuwe gegevens
        $profile->fill($request->validated());

        // Als er een nieuwe profielfoto is geüpload, verwerk deze
        if ($request->hasFile('profile_picture')) {
            // Sla de afbeelding op
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $profile->profile_picture = $path;
        }

        // Sla het profiel op
        $profile->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Verwijder het account van de gebruiker.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        // Verwijder het profiel van de gebruiker
        $user->profile()->delete();

        // Verwijder de gebruiker
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    /**
 * Werk het wachtwoord van de gebruiker bij.
 */
public function updatePassword(Request $request): RedirectResponse
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    // Werk het wachtwoord bij
    $request->user()->update([
        'password' => bcrypt($request->password),
    ]);

    return Redirect::route('profile.edit')->with('status', 'password-updated');
}
}
