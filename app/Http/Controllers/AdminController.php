<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'moderator') {
            return redirect('/home')->with('error', 'Je hebt geen toestemming om deze pagina te bezoeken.');
        }

        $users = User::with('profile')->get();
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        if (Auth::user()->role !== 'moderator') {
            return redirect('/home')->with('error', 'Je hebt geen toestemming om deze pagina te bezoeken.');
        }

        $user = User::with('profile')->findOrFail($user->id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'moderator') {
            return redirect('/home')->with('error', 'Je hebt geen toestemming om deze pagina te bezoeken.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'De gebruiker is succesvol verwijderd.');
    }

    public function edit(User $user)
    {
        if (Auth::user()->role !== 'moderator') {
            return redirect('/home')->with('error', 'Je hebt geen toestemming om deze pagina te bezoeken.');
        }

        $user = User::with('profile')->findOrFail($user->id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (Auth::user()->role !== 'moderator') {
            return redirect('/home')->with('error', 'Je hebt geen toestemming om deze pagina te bezoeken.');
        }

        $user = User::with('profile')->findOrFail($user->id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:koper,maker,moderator',  // Zorg ervoor dat alleen toegestane rollen gekozen kunnen worden
            'bio' => 'nullable|string|max:1000',
        ]);

        $user->update($validated);

        if ($request->has('bio')) {
            if ($user->profile) {
                $user->profile->update(['bio' => $request->bio]);
            }
        }

        return redirect()->route('admin.users.index')->with('success', 'Gebruiker succesvol bijgewerkt.');
    }
}
