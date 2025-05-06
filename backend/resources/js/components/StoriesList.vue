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
import ChapterView from './ChapterView.vue'; // ✅ L'import doit être ici (pas dans le template)

const stories = ref([]);
const currentStory = ref(null);
const currentChapter = ref(null);

onMounted(async () => {
    try {
        const response = await fetch('/api/stories');
        const data = await response.json();
        console.log('Stories data:', data);

        stories.value = data.data ?? data;

        if (stories.value.length > 0) {
            // Directement démarrer la première histoire
            startStory(stories.value[0]);
        }
    } catch (error) {
        console.error('Erreur lors de la récupération des histoires :', error);
    }
});

function startStory(story) {
    currentStory.value = story;
    currentChapter.value = story.chapters[0]; // Commencer par le premier chapitre
}

function selectChoice(choice) {
    if (!choice.next_chapter_id) {
        alert("Fin de l'histoire 🎉");
        currentChapter.value = null;
        return;
    }

    const nextChapter = currentStory.value.chapters.find(
        (chapter) => chapter.id === choice.next_chapter_id
    );

    if (nextChapter) {
        currentChapter.value = nextChapter;
    } else {
        console.warn('Chapitre suivant non trouvé.');
        alert("Fin de l'histoire 🎉");
        currentChapter.value = null;
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
