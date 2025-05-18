<template>
   <!-- Wrapper principal pour centrer le contenu -->
    <div class="chapter-wrapper">
       <!-- Carte contenant le chapitre et ses choix -->
      <div class="chapter-card">
         <!-- Titre et contenu du chapitre -->
        <h2>{{ chapter.title }}</h2>
        <p>{{ chapter.content }}</p>
        <!-- Liste des choix disponibles -->
        <ul class="choices-list">
          <li v-for="(choice, i) in chapter.choices" :key="choice.id">
              <!-- Bouton émettant l'événement de sélection -->
            <button @click="$emit('choice-selected', choice)">
              {{ choice.content }}
            </button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  /**
 * Composant d'affichage d'un chapitre
 * Props:
 * - chapter: Objet contenant title, content et choices[]
 * Events émis:
 * - choice-selected: Envoyé quand un choix est cliqué
 */
  defineProps({
    chapter: Object
  })
  </script>
  
  <style scoped>

  /* Structure générale */
  /* wrapper centré */
  .chapter-wrapper {
    display: flex;
    justify-content: center;
    padding: 2rem 1rem;
  }
  
  /* Design de la carte */
  /* carte au milieu avec max-width */
  .chapter-card {
    width: 100%;
    max-width: 700px;
    background-color: #f5f7ff;
    border: 1px solid #d1dbf0;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
  }
  
  /* Typographie et espacement */
  /* titres & texte */
  .chapter-card h2 {
    margin-top: 0;
    color: #304080;
    font-size: 1.75rem;
  }
  .chapter-card p {
    color: #4a4a4a;
    line-height: 1.6;
    margin-bottom: 1.5rem;
  }
  
  /* Layout des choix en grille flexible */
  /* liste flex pour les boutons */
  .choices-list {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  /* Style des boutons de choix */
  button {
    flex: 1 1 calc(50% - 1rem);
    min-width: 220px;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
  
 /* Alternance de couleurs pour les boutons */
  .choices-list li:nth-child(2n+1) button {
    background-color: #ffe3e3;
    color: #5a2a2a;
  }
  .choices-list li:nth-child(2n) button {
    background-color: #fff4cc;
    color: #5a4a00;
  }
  
 /* Animation au survol */
  button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  }
  </style>
  