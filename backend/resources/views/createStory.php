<!DOCTYPE html>
<!-- 
    Vue pour la création d'histoire
    Accessible uniquement aux administrateurs
    Permet de:
    - Créer une nouvelle histoire interactive
    - Ajouter des chapitres et des choix
    - Définir les impacts sur les métriques
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une nouvelle histoire - PawCare</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <nav>
            <a href="/" class="nav-button">
                <i class="fas fa-arrow-left"></i>
                Accueil
            </a>
        </nav>
    </header>

    <main class="create-container">
        <section class="story-form">
            <h1>Créer une nouvelle histoire</h1>
            
            <form>
                <div class="form-group">
                    <label>Titre de l'histoire</label>
                    <input type="text" class="form-control" placeholder="Ex: Les aventures de Mistigri"required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" placeholder="Décrivez brièvement votre histoire..."required></textarea>
                </div>
                <button type="submit" class="submit-button">
        <i class="fas fa-plus"></i>
        Créer l'histoire
        </button>
            </form>
        </section>

        <section class="story-templates">
            <h2>Suggestions de trames</h2>
            <div class="template-grid">
                <div class="template-card">
                    <i class="fas fa-home template-icon"></i>
                    <h3>Premier jour à la maison</h3>
                    <p>Une histoire sur l'adaptation d'un chaton dans sa nouvelle famille</p>
                </div>
                <div class="template-card">
                    <i class="fas fa-clinic-medical template-icon"></i>
                    <h3>Visite chez le vétérinaire</h3>
                    <p>Une aventure autour des soins et de la santé</p>
                </div>
                <div class="template-card">
                    <i class="fas fa-gamepad template-icon"></i>
                    <h3>Temps de jeu</h3>
                    <p>Exploration des activités ludiques et enrichissantes</p>
                </div>


            </div>
        </section>
    </main>

    <script setup>
import { ref, reactive } from 'vue'

const story = reactive({
  title: '',
  description: ''
})

// Templates prédéfinis
const templates = ref([
  {
    id: 1,
    icon: 'fas fa-home',
    title: 'Premier jour à la maison',
    description: 'Une histoire sur l'adaptation d'un chaton dans sa nouvelle famille'
  },
  {
    id: 2,
    icon: 'fas fa-clinic-medical',
    title: 'Visite chez le vétérinaire',
    description: 'Une aventure autour des soins et de la santé'
  },
  {
    id: 3,
    icon: 'fas fa-gamepad',
    title: 'Temps de jeu',
    description: 'Exploration des activités ludiques et enrichissantes'
  }
])


// Histoires créées par l'utilisateur
const userStories = ref([])

const submitStory = async () => {
  try {
    // Envoyer l'histoire au backend
    const response = await fetch('/api/stories', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: JSON.stringify(story)
    })

    if (response.ok) {
      // Ajouter l'histoire aux suggestions
      userStories.value.push({
        id: Date.now(), // Temporaire, à remplacer par l'ID retourné par le backend
        title: story.title,
        description: story.description
      })

      // Réinitialiser le formulaire
      story.title = ''
      story.description = ''
    }
  } catch (error) {
    console.error('Erreur lors de la création:', error)
  }
}
</script>

<style scoped>


  
        :root {
            --font-system: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --primary: #3498db;
            --secondary: #2ecc71;
            --background: #f5f7fa;
        }

        body {
            font-family: var(--font-system);
            background: var(--background);
            margin: 0;
            padding: 0;
        }

        header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .create-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .story-form {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        .template-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .template-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }

        .template-card:hover {
            transform: translateY(-4px);
        }

        .template-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        h1 {
            color: #2c3e50;
            margin-top: 0;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
        }

        h3 {
            color: #2c3e50;
            margin: 0.5rem 0;
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

        .submit-button {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 6px;
    background: var(--secondary);
    color: white;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
    width: auto;
    margin-top: 1rem;
}

.submit-button:hover {
    background: #27ae60;
    transform: translateY(-1px);
}

.submit-button i {
    font-size: 0.9rem;
}
    </style>

</body>
</html>