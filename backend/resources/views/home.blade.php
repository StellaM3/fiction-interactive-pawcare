<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma Fiction Interactive</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/js/app.js') <!-- 🔥 super important -->
</head>
<body>
    <header>
    <nav>
    @if(Session::has('user_id'))
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="logout-button">Se déconnecter</button>
            </form>
        @else
            <a href="{{ url('/login') }}" class="login-link">Se connecter</a>
            <a href="{{ url('/create') }}"> créer une histoire</a>
        @endif
    </nav>
    </header>
    <div id="app">
        <stories-list></stories-list>
    </div>
</body>
</html>