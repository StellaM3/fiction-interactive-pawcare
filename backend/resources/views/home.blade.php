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
    <div id="app">
        <stories-list></stories-list>
    </div>
</body>
</html>