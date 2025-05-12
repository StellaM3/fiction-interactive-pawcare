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
const userChoices = ref([]) // Add this line to define userChoices ref
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



async function checkAuth() {
    try {
        const response = await fetch('/api/v1/check', {
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            credentials: 'include'
        });

        if (!response.ok) {
            window.location.href = '/login';
        }
    } catch (e) {
        console.error('Auth check failed:', e);
        window.location.href = '/login';
    }
}


  
/* ---------------------------------------------------- */
/* chargement initial : toutes les histoires            */
/* ---------------------------------------------------- */
onMounted(async () => {
  const res = await fetch('/api/v1/stories')
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
    await fetch('/api/v1/user-choices/reset', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'X-Requested-With': 'XMLHttpRequest',
        'X-API-Key': 'pawcare_2025'
      },
      credentials: 'same-origin',
      body: JSON.stringify({ user_id: 1 })
    })
  }

  userChoices.value = [] // NEW Reset choices when starting new story
  currentStory.value = story
  currentChapter.value = story.chapters[0]
}
  
/* ---------------------------------------------------- */
/* clic sur un choix                                    */
/* ---------------------------------------------------- */
async function selectChoice(choice) {
  await fetch('/api/v1/user-choices', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'X-Requested-With': 'XMLHttpRequest',
      'X-API-Key': 'pawcare_2025'
    },
    credentials: 'same-origin',
    body: JSON.stringify({ choice_id: choice.id, user_id: 1 })
  })

  // Add the choice to userChoices 13h08
  userChoices.value.push({
    id: choice.id,
    impact_bonheur: parseInt(choice.impact_bonheur || 0),
    impact_sante: parseInt(choice.impact_sante || 0),
    impact_energie: parseInt(choice.impact_energie || 0)
  })

  if (!choice.next_chapter_id) {
    if (currentStory.value.id === 1) {
      const r = await fetch('/api/v1/story1-result/1')
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
  //const userChoices = currentStory.value.chapters
    //.flatMap(chapter => chapter.choices)
    //.filter(choice => choice.selected)

  const totalScores = userChoices.value.reduce((acc, choice) => {
    acc.bonheur += parseInt(choice.impact_bonheur || 0) 
    acc.sante += parseInt(choice.impact_sante || 0) 
    acc.energie += parseInt(choice.impact_energie || 0) 
    return acc
  }, { bonheur: 0, sante: 0, energie: 0 })

  console.log('Choices array:', userChoices.value) // 🟢 ADD: Debug log
  console.log('Choices made:', userChoices.value.length)
  console.log('Total scores:', totalScores); // Debug scores

  const thresholds = {
    bonheur: 5,
    sante: 3,
    energie: 2
  }

  // Determine if scores meet thresholds for happy ending
  const isHappyEnding = totalScores.bonheur >= thresholds.bonheur &&
                       totalScores.sante >= thresholds.sante &&
                       totalScores.energie >= thresholds.energie

 const endings = currentStory.value.chapters.filter(chapter => 
    chapter.title?.includes('belle harmonie') || 
    chapter.title?.includes('débuts difficiles') ||
    chapter.title?.includes('duo inséparable') ||
    chapter.title?.includes('défis à surmonter'));
  


  const selectedEnding = isHappyEnding
    ? endings.find(chapter => chapter.title?.includes('harmonie') || chapter.title?.includes('duo'))
    : endings.find(chapter => chapter.title?.includes('difficiles') || chapter.title?.includes('défis'))

    // Reset choices for next story
    //if (endings.length) {
    //userChoices.value = []
  //}

  
    return selectedEnding 
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
