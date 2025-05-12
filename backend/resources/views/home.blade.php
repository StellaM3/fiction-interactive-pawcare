<!DOCTYPE html>
<html lang="fr">
<head>
     <!-- Meta tags pour SEO et responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Fiction Interactive</title>
     <!-- CSRF Token pour la sécurité des requêtes -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Vite pour la compilation des assets JavaScript -->
    @vite('resources/js/app.js') <!-- 🔥 super important -->
</head>
<body>
     <!-- En-tête avec navigation conditionnelle -->
    <header>
    <nav>
         <!-- Affichage conditionnel selon l'état de connexion -->
    @if(Session::has('user_id'))
     <!-- Formulaire de déconnexion pour utilisateur connecté -->
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="logout-button">Se déconnecter</button>
            </form>
        @else
        <!-- Liens de connexion et création pour visiteurs -->
            <a href="{{ url('/login') }}" class="login-link">Se connecter</a>
            <a href="{{ url('/create') }}"> créer une histoire</a>
        @endif
    </nav>
    </header>
     <!-- Conteneur principal pour l'application Vue.js -->
    <div id="app">
         <!-- Composant Vue pour afficher la liste des histoires -->
        <stories-list></stories-list>
    </div>
</body>
</html>