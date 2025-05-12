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
/* Conteneur principal centré verticalement et horizontalement */
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f3f4f6;
}
</style>