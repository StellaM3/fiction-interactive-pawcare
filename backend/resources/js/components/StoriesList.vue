<template>
    <div>
      <!-- Tant que currentChapter n'existe pas, on affiche "Chargement" -->
      <div v-if="!currentChapter">
        <p>Chargement en cours…</p>
      </div>
  
      <!-- Dès qu'on a un chapitre, on délègue à ChapterView -->
      <ChapterView
        v-else
        :chapter="currentChapter"
        @choice-selected="selectChoice"
      />
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import ChapterView from './ChapterView.vue'
  
  const stories        = ref([])
  const currentStory   = ref(null)
  const currentChapter = ref(null)
  
  // 1️⃣ Chargement initial : on va chercher TOUTES les stories
  onMounted(async () => {
    const res = await fetch('/api/stories')
    if (!res.ok) {
      console.error('Impossible de charger /api/stories', res.status)
      return
    }
  
    const json = await res.json()
    // gère { data: [...] } ou [...]
    stories.value = json.data ?? json
  
    if (stories.value.length) {
      // démarre la première histoire
      await startStory(stories.value[0])
    } else {
      console.error('Aucune story trouvée 😱')
    }
  })
  
  // Fonction pour lancer / relancer une story
  async function startStory(story) {
    // Si on relance la Story 1, on reset côté back (user‐choices)
    if (story.id === 1) {
      const resetRes = await fetch('/api/user-choices/reset', {
        method : 'POST',
        headers: { 'Content-Type':'application/json' },
        body   : JSON.stringify({ user_id: 1 })
      })
      if (!resetRes.ok && resetRes.status !== 404) {
        console.warn('Reset des choix impossible', resetRes.status)
      }
    }
  
    currentStory.value   = story
    currentChapter.value = story.chapters[0]
  }
  
  // Quand je clique sur un choix
  async function selectChoice(choice) {
    // 🌱 1) On enregistre le choix
    const saveRes = await fetch('/api/user-choices', {
      method : 'POST',
      headers: { 'Content-Type':'application/json' },
      body   : JSON.stringify({ choice_id: choice.id, user_id: 1 })
    })
    if (!saveRes.ok) {
      console.warn('Enregistrement du choix échoué', saveRes.status)
    }
  
    // 🔀 2) Si next_chapter_id est null, c'est la fin de la Story 1
    if (!choice.next_chapter_id) {
  const res  = await fetch('/api/story1-result/1');
  if (!res.ok) {
    console.error('Erreur /api/story1-result/1', res.status);
    return;
  }
  const data = await res.json();
  console.log('Résultat Story 1:', data);

  const next = stories.value.find(s => s.id === data.next_story_id);
  if (next) await startStory(next);
  else      alert("Story suivante introuvable 😅");

  return;
}
  
    // ➡️ navigation Chapitre → Chapitre
    const suivant = currentStory.value.chapters
                      .find(c => c.id === choice.next_chapter_id)
    if (suivant) {
      currentChapter.value = suivant
    } else {
      console.warn('Chapitre suivant introuvable pour id', choice.next_chapter_id)
      currentChapter.value = null
    }
  }
  </script>
  
  <style scoped>
  .chapter-card {
    border: 1px solid #ccc;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
  }
  </style>
  