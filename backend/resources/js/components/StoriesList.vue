<!-- resources/js/components/StoriesList.vue -->
<template>
    <div>
      <!-- Affiche le chapitre courant -->
      <ChapterView
        v-if="currentChapter"
        :chapter="currentChapter"
        @choice-selected="selectChoice"
      />
      <!-- Sinon, simple loader -->
      <p v-else>Chargement…</p>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue'
  import ChapterView        from './ChapterView.vue'
  
  /* ---------------------------------------------------- */
  /* state réactif                                         */
  /* ---------------------------------------------------- */
  const stories        = ref([])
  const currentStory   = ref(null)
  const currentChapter = ref(null)
  
  /* ---------------------------------------------------- */
  /* chargement initial : toutes les histoires            */
  /* ---------------------------------------------------- */
  onMounted(async () => {
    const res  = await fetch('/api/stories')
    const json = await res.json()
    stories.value = json.data ?? json          // tableau réel
  
    if (stories.value.length) {
      startStory(stories.value[0])
    } else {
      console.error('Aucune story trouvée')
    }
  })
  
  /* ---------------------------------------------------- */
  /* démarre / redémarre une histoire                     */
  /* ---------------------------------------------------- */
  async function startStory(story) {
  // ── seulement pour la Story 1 : on vide les anciens choix ──
  if (story.id === 1) {
    await fetch('/api/user-choices/reset', {
      method: 'POST',
      headers: {
        'Content-Type'     : 'application/json',
        'X-XSRF-TOKEN'     : document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With' : 'XMLHttpRequest'
      },
      credentials: 'same-origin',
      body: JSON.stringify({ user_id: 1 })
    });
  }

  currentStory.value   = story;
  currentChapter.value = story.chapters[0];
}
  
  /* ---------------------------------------------------- */
  /* clic sur un choix                                    */
  /* ---------------------------------------------------- */
  async function selectChoice(choice) {
  await fetch('/api/user-choices', {
    method: 'POST',
    headers: {
      'Content-Type'     : 'application/json',
      'X-XSRF-TOKEN'     : document.querySelector('meta[name="csrf-token"]').content,
      'X-Requested-With' : 'XMLHttpRequest'
    },
    credentials: 'same-origin',
    body: JSON.stringify({ choice_id: choice.id, user_id: 1 })
  });

  
    /* fin de la Story 1 → calcul chat/chien */
    if (!choice.next_chapter_id) {
      const r   = await fetch('/api/story1-result/1')
      const dat = await r.json()
      console.log(dat)
      const next = stories.value.find(s => s.id === dat.next_story_id)
      if (next) startStory(next)
      else      alert('Story suivante introuvable')
      return
    }
  
    /* navigation normale chapitre → chapitre */
    currentChapter.value =
      currentStory.value.chapters.find(c => c.id === choice.next_chapter_id)
  }
  </script>
  
  <style scoped>
  .chapter-card{
    border:1px solid #ccc;
    padding:1rem;
    margin-bottom:1rem;
    border-radius:8px;
  }
  </style>
  