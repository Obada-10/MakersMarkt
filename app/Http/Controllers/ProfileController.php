<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    // User updaten
    $user->fill($request->validated());

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    $user->save();

    // Profiel ophalen of aanmaken als het nog niet bestaat
    $profile = $user->profile ?: new \App\Models\Profile([
        'user_id' => $user->id,
        'name' => $user->name, // Optioneel
    ]);
    $profile->bio = $request->input('bio');

    // Profielfoto opslaan
    if ($request->hasFile('profile_picture')) {
        if ($profile->profile_picture) {
            \Storage::delete('public/' . $profile->profile_picture);
        }

        // Bestand opslaan in de opslag en pad toewijzen
        $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        $profile->profile_picture = $path;
    }

    $profile->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    
}
