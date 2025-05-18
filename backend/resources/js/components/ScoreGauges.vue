<template>
    <div class="gauges-container">
      <div class="gauge">
        <label>Bonheur</label>
        <div class="gauge-bar">
          <div class="gauge-fill" :style="{ width: `${(scores.bonheur / maxScores.bonheur) * 100}%`, backgroundColor: '#FFD700' }"></div>
        </div>
        <span>{{ scores.bonheur }}/{{ maxScores.bonheur }}</span>
      </div>
      <div class="gauge">
        <label>Santé</label>
        <div class="gauge-bar">
          <div class="gauge-fill" :style="{ width: `${(scores.sante / maxScores.sante) * 100}%`, backgroundColor: '#FF6B6B' }"></div>
        </div>
        <span>{{ scores.sante }}/{{ maxScores.sante }}</span>
      </div>
      <div class="gauge">
        <label>Énergie</label>
        <div class="gauge-bar">
          <div class="gauge-fill" :style="{ width: `${(scores.energie / maxScores.energie) * 100}%`, backgroundColor: '#4ECDC4' }"></div>
        </div>
        <span>{{ scores.energie }}/{{ maxScores.energie }}</span>
      </div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    scores: {
      type: Object,
      required: true
    },
    maxScores: {
      type: Object,
      default: () => ({
        bonheur: 14,
        sante: 10,
        energie: 8
      })
    }
  })
  </script>
  
  <style scoped>
  .gauges-container {
    padding: 1rem;
    background: #f5f5f5;
    border-radius: 8px;
    margin: 1rem 0;
  }
  
  .gauge {
    margin-bottom: 1rem;
  }
  
  .gauge label {
    display: block;
    margin-bottom: 0.5rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    font-weight: bold;
  }
  
  .gauge-bar {
    width: 100%;
    height: 20px;
    background: #ddd;
    border-radius: 10px;
    overflow: hidden;
  }
  
  .gauge-fill {
    height: 100%;
    transition: width 0.3s ease;
  }
  
  .gauge span {
    font-size: 0.8rem;
    color: #666;
    margin-top: 0.25rem;
    display: block;
  }
  </style>