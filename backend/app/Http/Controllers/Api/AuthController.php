<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    public function getAuthenticateForm()
    {
            return view('auth');
    }
    public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Vérification explicite des credentials
    if ($credentials['email'] === 'admin@example.com' && $credentials['password'] === '123456') {
        Session::put('user_id', 2); // Store admin ID in session
        $request->session()->regenerate();
        return redirect('/create');
    }
    
    if ($credentials['email'] === 'test@example.com' && $credentials['password'] === '123456') {
        Session::put('user_id', 1); // Store guest ID in session
        $request->session()->regenerate();
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas.',
    ])->onlyInput('email');
}

// Logout function
public function logout(Request $request)
{
    // Supprimer l'ID de l'utilisateur de la session
    Session::forget('user_id');
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    

    return redirect('/login')->with('success', 'Déconnexion réussie.');
}
}