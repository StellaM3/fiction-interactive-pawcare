<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

/**
 * Gère l'authentification des utilisateurs
 * Inclut la connexion, déconnexion et affichage du formulaire
 */
class AuthController extends Controller
{
    public function getAuthenticateForm()
    {
            return view('auth');
    }
    /**
     * Traite la tentative de connexion
     * Vérifie les credentials et redirige selon le type d'utilisateur
     */
    public function authenticate(Request $request)
{
    // Validation des champs du formulaire
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Vérification explicite des credentials
    if ($credentials['email'] === 'admin@example.com' && $credentials['password'] === '123456') {
        Session::put('user_id', 2); // Store admin ID in session
        $request->session()->regenerate();// Régénère la session pour la sécurité
        return redirect('/create'); // Redirige vers la page de création
    }
    // Vérifie si c'est l'utilisateur test
    if ($credentials['email'] === 'test@example.com' && $credentials['password'] === '123456') {
        Session::put('user_id', 1); // Store guest ID in session
        $request->session()->regenerate();// Régénère la session pour la sécurité
        return redirect('/'); // Redirige vers la page d'accueil
    }
     // Si les credentials sont invalides, retourne au formulaire avec une erreur
    return back()->withErrors([
        'email' => 'Les identifiants fournis ne correspondent pas.',
    ])->onlyInput('email');
}

// Déconnecte l'utilisateur
// Nettoie la session et redirige vers la page de login
public function logout(Request $request)
{
    
    Session::forget('user_id');// Supprimer l'ID de l'utilisateur de la session
    $request->session()->invalidate(); // Invalide la session entière
    $request->session()->regenerateToken();// Régénère le token CSRF
    
    // Redirige vers la page de login avec un message de succès
    return redirect('/login')->with('success', 'Déconnexion réussie.');
}
}