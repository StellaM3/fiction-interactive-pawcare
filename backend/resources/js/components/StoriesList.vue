<template>
    <div>
        <!-- Chapitre en cours -->
        <ChapterView
            v-if="currentChapter"
            :chapter="currentChapter"
            @choice-selected="selectChoice"
        />
        <div v-else>
            <p>Chargement en cours...</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ChapterView from './ChapterView.vue';

const stories        = ref([]);
const currentStory   = ref(null);
const currentChapter = ref(null);

// ➜ tableau local des ID de choix réellement cliqués
const selectedChoices = ref([]);

onMounted(async () => {
    const res   = await fetch('/api/stories');
    const data  = await res.json();          // JSON reçu depuis l’API

    // Certaines implémentations renvoient { data:[…] }, d’autres renvoient directement un tableau.
    stories.value = data.data ?? data;       // on gère les deux cas

    if (stories.value.length) {
        startStory(stories.value[0]);        // démarre la première histoire
    } else {
        console.error('Aucune story trouvée 😱');
    }
});

function startStory(story) {
    currentStory.value   = story;
    currentChapter.value = story.chapters[0];
    selectedChoices.value = [];                // reset quand on redémarre
}

async function selectChoice(choice) {

    /* 1️⃣  POST le choix à l’API ------------------------------------ */
    await fetch('/api/user-choices', {
        method : 'POST',
        headers: { 'Content-Type': 'application/json' },
        body   : JSON.stringify({
            choice_id : choice.id,
            user_id   : 1            // provisoire : même ID que dans /story1-result/1
        })
    });
    selectedChoices.value.push(choice.id);

    /* 2️⃣  Navigation normale -------------------------------------- */
    if (!choice.next_chapter_id) {
        // story terminée ⇒ on demande le résultat
        const r = await fetch('/story1-result/1');          // même user_id
        const data = await r.json();

        const next = stories.value.find(s => s.id === data.next_story_id);
        if (next) startStory(next);
        else alert('Story suivante introuvable');
        return;
    }

    const nextChapter = currentStory.value.chapters
                       .find(c => c.id === choice.next_chapter_id);

    currentChapter.value = nextChapter ?? null;
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
