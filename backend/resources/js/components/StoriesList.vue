<!-- resources/js/components/StoriesList.vue -->
<template>
    <div>
      <!-- Affiche le chapitre courant -->
      <ChapterView
        v-if="currentChapter"
        :chapter="getDisplayedChapter"
        @choice-selected="selectChoice"
      />
      <!-- Sinon, simple loader -->
      <p v-else>Chargement…</p>
    </div>
</template>
  
<script setup>
import { ref, onMounted, computed } from 'vue'
import ChapterView from './ChapterView.vue'
  
/* ---------------------------------------------------- */
/* state réactif                                         */
/* ---------------------------------------------------- */
const stories = ref([])
const currentStory = ref(null)
const currentChapter = ref(null)

/* ---------------------------------------------------- */
/* computed property pour gérer l'affichage              */
/* ---------------------------------------------------- */
const getDisplayedChapter = computed(() => {
  if (!currentChapter.value || !currentStory.value) return null
  
  // Si c'est la fin des stories 2 ou 3, calculer la bonne fin
  if (!currentChapter.value.choices?.length && [2, 3].includes(currentStory.value.id)) {
    return determineEnding() || currentChapter.value
  }
  
  return currentChapter.value
})
  
/* ---------------------------------------------------- */
/* chargement initial : toutes les histoires            */
/* ---------------------------------------------------- */
onMounted(async () => {
  const res = await fetch('/api/stories')
  const json = await res.json()
  stories.value = json.data ?? json
  
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
  if (story.id === 1) {
    await fetch('/api/user-choices/reset', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest'
      },
      credentials: 'same-origin',
      body: JSON.stringify({ user_id: 1 })
    })
  }

  currentStory.value = story
  currentChapter.value = story.chapters[0]
}
  
/* ---------------------------------------------------- */
/* clic sur un choix                                    */
/* ---------------------------------------------------- */
async function selectChoice(choice) {
  await fetch('/api/user-choices', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'X-Requested-With': 'XMLHttpRequest'
    },
    credentials: 'same-origin',
    body: JSON.stringify({ choice_id: choice.id, user_id: 1 })
  })

  if (!choice.next_chapter_id) {
    if (currentStory.value.id === 1) {
      const r = await fetch('/api/story1-result/1')
      const dat = await r.json()
      const next = stories.value.find(s => s.id === dat.next_story_id)
      if (next) startStory(next)
      else alert('Story suivante introuvable')
      return
    }
    
    // Pour Story 2 et 3, on affiche la fin appropriée
    if ([2, 3].includes(currentStory.value.id)) {
      const endingChapter = determineEnding()
      if (endingChapter) {
        currentChapter.value = endingChapter
      }
      return
    }
  }

  currentChapter.value = currentStory.value.chapters.find(c => c.id === choice.next_chapter_id)
}

/* ---------------------------------------------------- */
/* fonction pour calculer les scores et choisir la fin   */
/* ---------------------------------------------------- */
function determineEnding() {
  const userChoices = currentStory.value.chapters
    .flatMap(chapter => chapter.choices)
    .filter(choice => choice.selected)

  const totalScores = userChoices.reduce((acc, choice) => {
    acc.bonheur += choice.impact_bonheur || 0
    acc.sante += choice.impact_sante || 0
    acc.energie += choice.impact_energie || 0
    return acc
  }, { bonheur: 0, sante: 0, energie: 0 })

  const thresholds = {
    bonheur: 5,
    sante: 3,
    energie: 2
  }

  const isHappyEnding = totalScores.bonheur >= thresholds.bonheur &&
                       totalScores.sante >= thresholds.sante &&
                       totalScores.energie >= thresholds.energie

  const endings = currentStory.value.chapters.filter(chapter => 
    chapter.title?.includes('belle harmonie') || 
    chapter.title?.includes('débuts difficiles') ||
    chapter.title?.includes('duo inséparable') ||
    chapter.title?.includes('défis à surmonter')
  )

  return isHappyEnding 
    ? endings.find(chapter => chapter.title?.includes('harmonie') || chapter.title?.includes('duo'))
    : endings.find(chapter => chapter.title?.includes('difficiles') || chapter.title?.includes('défis'))
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
