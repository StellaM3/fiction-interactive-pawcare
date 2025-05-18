<!DOCTYPE html>
<html lang="fr">
<head>
     <!-- Meta tags pour SEO et responsive design -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Fiction Interactive</title>
     <!-- CSRF Token pour la sécurité des requêtes -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Ajout de Font Awesome pour les icônes -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Vite pour la compilation des assets JavaScript -->
    @vite('resources/js/app.js') <!-- 🔥 super important -->
    <style>
        header {
            background: #2c3e50;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        nav {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .nav-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 6px;
            background: #3498db;
            color: white;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .nav-button:hover {
            background: #2980b9;
            transform: translateY(-1px);
        }

        .logout-button {
            background: #e74c3c;
        }

        .logout-button:hover {
            background: #c0392b;
        }

        .create-button {
            background: #2ecc71;
        }

        .create-button:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
     <!-- En-tête avec navigation conditionnelle -->
    <header>
    <nav>
         <!-- Logo à gauche -->
         <div class="logo">
            <i class="fas fa-paw"></i>
            <span>PawCare</span>
        </div>
        <div class="nav-buttons">
         <!-- Affichage conditionnel selon l'état de connexion -->
    @if(Session::has('user_id'))
     <!-- Formulaire de déconnexion pour utilisateur connecté -->
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="nav-button logout-button">
                        <i class="fas fa-sign-out-alt"></i>
                        Se déconnecter
                    </button>
                    <a href="{{ url('/create') }}" class="nav-button create-button">
                    <i class="fas fa-plus"></i>
                    Créer une histoire
                </a>
                
            </form>
        @else
        <!-- Liens de connexion et création pour visiteurs -->
        <a href="{{ url('/login') }}" class="nav-button">
                    <i class="fas fa-sign-in-alt"></i>
                    Se connecter
                </a>
                <a href="{{ url('/create') }}" class="nav-button create-button">
                    <i class="fas fa-plus"></i>
                    Créer une histoire
                </a>
        @endif
        </div>
    </nav>
    </header>
     <!-- Conteneur principal pour l'application Vue.js -->
    <div id="app">
         <!-- Composant Vue pour afficher la liste des histoires -->
        <stories-list></stories-list>
    </div>
    <footer class="site-footer">
        <p>
            Une fiction interactive conçue par Estelle Rossier
            <span class="separator">•</span> 
            Mai 2025
            <span class="separator">•</span>
            HEIG-VD
        </p>
    </footer>
</body>

<style>
    :root {
        --font-system: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    * {
        font-family: var(--font-system);
    }

    header {
        background: #2c3e50;
        padding: 1rem 2rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    nav {
        display: flex;
        /*justify-content: flex-end;*/
        justify-content: space-between;  /* Change from flex-end to space-between */
        align-items: center;
        gap: 1rem;
        max-width: 1200px;
        margin: 0 auto;
    }

    .logo {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    font-size: 1.5rem;
    font-weight: bold;
}

.logo i {
    color: #3498db;
}

    .nav-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 6px;
        background: #3498db;
        color: white;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        font-family: var(--font-system);
    }

    .nav-button:hover {
        background: #2980b9;
        transform: translateY(-1px);
    }

    .logout-button {
        background: #e74c3c;
    }

    .logout-button:hover {
        background: #c0392b;
    }

    .create-button {
        background: #2ecc71;
    }

    .create-button:hover {
        background: #27ae60;
    }

    .site-footer {
        padding: 2rem;
        text-align: center;
        color: #7f8c8d;
        font-size: 0.9rem;
        margin-top: auto;
        background: #f8f9fa;
        border-top: 1px solid #eee;
    }

    .site-footer p {
        margin: 0;
        line-height: 1.6;
    }

    .site-footer i {
        color: #e74c3c;
        margin: 0 0.2rem;
        font-size: 0.8rem;
    }

    .site-footer .separator {
        margin: 0 0.5rem;
        opacity: 0.5;
    }

    /* Assurez-vous que le footer reste en bas */
    body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    #app {
        flex: 1;
    }

    /* Style global pour les boutons et textes */
    button, 
    input,
    a {
        font-family: var(--font-system);
    }
</style>
</html>