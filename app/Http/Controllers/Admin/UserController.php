<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Lijst van alle gebruikers
     */
    public function index()
    {
        $users = User::all(); // Of paginate() voor pagina's
        return view('admin.userManagement.index', compact('users'));
    }

    /**
     * Toon details van een specifieke gebruiker
     */
    public function show(User $user)
    {
        return view('admin.userManagement.show', compact('user'));
    }

    /**
     * Toon formulier om gebruiker te bewerken (bijv. rol)
     */
    public function edit(User $user)
    {
        return view('admin.userManagement.edit', compact('user'));
    
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|string|in:user,seller,moderator,admin',
            'password' => 'required|string|min:6|confirmed', // als je password confirmation gebruikt
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.userManagement.index')->with('success', 'User created successfully.');
    }
    /**
     * Update een gebruiker in de database
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|string|in:user,admin', // Of andere rollen
        ]);

        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.userManagement.index')->with('success', 'User updated successfully.');
    }

    /**
     * Verwijder een gebruiker
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.userManagement.index')->with('success', 'User deleted successfully.');
    }
}
