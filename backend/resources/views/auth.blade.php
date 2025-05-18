<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Meta tags pour responsive design et CSRF protection -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PawCare</title>
     <!-- Vite pour compilation des assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  
</head>
<body>

<header>
        <nav>
            <a href="/" class="nav-button">
                <i class="fas fa-home"></i>
                Accueil
            </a>
        </nav>
    </header>

     <!-- Conteneur Vue.js -->
    <div id="app">
         <!-- Conteneur centré pour le formulaire de login -->
        <div class="login-container">
            <!-- Formulaire d'authentification avec CSRF protection -->
        <form method="POST" action="{{ url('/authenticate') }}">
    @csrf
     <!-- Groupe Email avec validation et message d'erreur -->
    <div class="form-group">
                    <label for="email">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        class="form-control"
                        value="{{ old('email') }}"
                    >
                     <!-- Affichage des erreurs de validation -->
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                 <!-- Groupe Password avec sécurité renforcée -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        class="form-control"
                    >
                </div>

                 <!-- Bouton de soumission du formulaire -->
                <button type="submit" class="login-button">Se connecter</button>
</form>
        </div>
    </div>
</body>
</html>
<!-- Styles spécifiques à la page de login -->
<style>
/* Variables globales */
:root {
    --font-system: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

* {
    --font-system: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    --primary: #3498db;    /* Ajout de la variable primary */
    --primary-dark: #2980b9;
}

header {
    background: #2c3e50;
    padding: 1rem 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Conteneur principal centré verticalement et horizontalement */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f3f4f6;
}




.login-button {
    padding: 0.75rem 1.5rem;
    font-size: 1.1rem;
    width: 100%;
    border: none;
    border-radius: 6px;
    background: #3498db;
    color: white;
    cursor: pointer;
    transition: all 0.2s ease;
}

.login-button:hover {
    background: #2980b9;
    transform: translateY(-1px);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.nav-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .nav-button:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }


label {
    display: block;
    margin-bottom: 0.5rem;}
</style>