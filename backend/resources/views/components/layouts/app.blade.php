<!-- 
    Layout principal de l'application
    Utilisé comme template de base pour toutes les vues
    Intègre:
    - Configuration meta pour responsive/SEO
    - Assets compilés via Vite
    - Conteneur Vue.js
-->
<!doctype html>
<html lang="en">
<head>
    <!-- Meta tags pour responsive et compatibilité -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Titre dynamique depuis la config -->
    <title>{{ config('app.name') }}</title>

   
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
     <!-- Container principal pour Vue.js -->
    <div id="app">
         <!-- Injection du contenu dynamique via $slot -->
        {{ $slot }}
    </div>
</body>
</html>