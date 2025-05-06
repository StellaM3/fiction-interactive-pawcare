<template>
    <div class="chapter-card">
        <h2>{{ chapter.title }}</h2>
        <p>{{ chapter.content }}</p>
        <ul>
            <li v-for="choice in chapter.choices" :key="choice.id">
                <button @click="$emit('choice-selected', choice)">
                    {{ choice.content }}
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
defineProps({
    chapter: Object
});
</script>

<style scoped>
.chapter-card {
    border: 1px solid #ccc;
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 8px;
}
button {
    padding: 0.5rem 1rem;
    margin: 0.5rem 0;
    border: none;
    border-radius: 4px;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}
button:hover {
    background-color: #0056b3;
}
</style>
