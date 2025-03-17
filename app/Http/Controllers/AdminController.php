<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Toon de gebruikerslijst
    public function index()
    {
        // Haal alle gebruikers op, inclusief hun profielgegevens
        $users = User::with('profile')->get();  
        return view('admin.users.index', compact('users'));
    }

    // Toon het gebruikersprofiel
    public function show(User $user)
    {
        // Haal het gebruikersprofiel op, inclusief profielgegevens
        $user = User::with('profile')->findOrFail($user->id);
        return view('admin.users.show', compact('user'));
    }

    // Verwijder een gebruiker
    public function destroy(User $user)
    {
        // Verwijder de gebruiker en hun gerelateerde gegevens
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'De gebruiker is succesvol verwijderd.');
    }

    // Toon het bewerk-scherm voor een gebruiker
    public function edit(User $user)
    {
        // Laad de 'profile' relatie samen met de gebruiker
        $user = User::with('profile')->findOrFail($user->id);
        
        // Stuur het gebruikersobject naar de edit view
        return view('admin.users.edit', compact('user'));
    }

    // Werk de gegevens van een gebruiker bij
    public function update(Request $request, User $user)
    {
        // Laad de 'profile' relatie om toegang te krijgen tot profielgegevens
        $user = User::with('profile')->findOrFail($user->id);

        // Valideer de input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:koper,maker,moderator',  // Zorg ervoor dat alleen toegestane rollen gekozen kunnen worden
            'bio' => 'nullable|string|max:1000',
        ]);

        // Werk de gegevens bij
        $user->update($validated);

        // Optioneel: Je kan hier ook de profielgegevens bijwerken, bijvoorbeeld de profiel bio als die wordt opgeslagen in een aparte tabel
        if ($request->has('bio')) {
            // Bijwerken van profielinformatie als dat nodig is
            if ($user->profile) {
                $user->profile->update(['bio' => $request->bio]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
    }
}
