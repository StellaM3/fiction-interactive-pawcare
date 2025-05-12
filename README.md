# 🐾 Fiction Interactive PawCare

Une fiction interactive sur l'adoption et les soins des animaux de compagnie chats et chiens, développée avec Laravel et Vue.js par Estelle Rossier.

## 📋 Description

PawCare est une application web interactive qui guide les utilisateurs à travers l'expérience d'adoption d'un animal de compagnie. L'histoire se déroule en trois parties :
1. Un questionnaire pour déterminer quel animal correspond le mieux à votre style de vie
2. Une histoire interactive sur la vie avec un chat
3. Une histoire interactive sur la vie avec un chien

## 🔧 Installation

### Prérequis
- PHP 8.1+
- Composer
- Node.js & NPM
- SQLite 

### Étapes d'installation

1. Cloner le repository
```bash
git clone https://github.com/StellaM3/fiction-interactive-pawcare.git
cd fiction-interactive-pawcare 
```

2. Installer les dépendances PHP
```bash
cd backend
composer install
```

3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de données dans .env
```
DB_CONNECTION=sqlite
```

5. Créer la base de données et exécuter les migrations
```bash
touch database/database.sqlite
php artisan migrate
php artisan db:seed --class=StorySeeder
```

6. Installer les dépendances JavaScript
```bash
npm install
```

7. Lancer les serveurs de développement
```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev

# Ou directement
composer run dev
```

## 🎮 Fonctionnalités

- Système de choix multiples influençant l'histoire
- Calcul de scores (bonheur, santé, énergie)
- Différentes fins possibles selon vos choix
- Navigation fluide entre les chapitres
- Interface responsive

## 🛠 Technologies utilisées

- Backend: Laravel 12
- Frontend: Vue.js 3
- Base de données: SQLite
- API RESTful
- Vite pour le build frontend

## 📝 Structure du projet

```
fiction-interactive-pawcare/
├── backend/
│   ├── app/
│   ├── database/
│   │   ├── migrations/
│   │   └── seeders/
│   └── routes/
└── frontend/
    └── resources/
        └── js/
            └── components/
```

## 📄 License

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.
