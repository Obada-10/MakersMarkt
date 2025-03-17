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
        // Haal het gebruikersprofiel op
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
        // Stuur het gebruikersobject naar de edit view
        return view('admin.users.edit', compact('user'));
    }

    // Werk de gegevens van een gebruiker bij
    public function update(Request $request, User $user)
{
    // Valideer de input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|in:koper,maker,moderator',  // Zorg ervoor dat alleen toegestane rollen gekozen kunnen worden
        'bio' => 'nullable|string|max:1000',
    ]);

    // Werk de gegevens bij
    $user->update($validated);

    // Optioneel: Je kan hier ook een relatie bijwerken, bijvoorbeeld de profiel bio als je die opslaat in een aparte tabel

    return redirect()->route('admin.users.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
}
}
