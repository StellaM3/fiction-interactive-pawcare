<template>
    <div class="chapter-wrapper">
      <div class="chapter-card">
        <h2>{{ chapter.title }}</h2>
        <p>{{ chapter.content }}</p>
        <ul class="choices-list">
          <li v-for="(choice, i) in chapter.choices" :key="choice.id">
            <button @click="$emit('choice-selected', choice)">
              {{ choice.content }}
            </button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    chapter: Object
  })
  </script>
  
  <style scoped>
  /* wrapper centré */
  .chapter-wrapper {
    display: flex;
    justify-content: center;
    padding: 2rem 1rem;
  }
  
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
  
  /* liste flex pour les boutons */
  .choices-list {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  /* boutons plus gros */
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
  
  /* garder tes couleurs pastel alternées */
  .choices-list li:nth-child(2n+1) button {
    background-color: #ffe3e3;
    color: #5a2a2a;
  }
  .choices-list li:nth-child(2n) button {
    background-color: #fff4cc;
    color: #5a4a00;
  }
  
  /* hover effet léger */
  button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
  }
  </style>
  