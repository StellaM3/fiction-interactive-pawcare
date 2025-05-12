<template>
     <!-- Formulaire de connexion avec validation et gestion d'erreurs -->
    <div class="login-form">
        <form @submit.prevent="handleLogin">
             <!-- Champ Email avec validation HTML5 -->
            <div class="form-group">
                <label for="email">Email</label>
                <input 
                    id="email"
                    v-model="email" 
                    type="email" 
                    required
                    class="form-control"
                >
            </div>

             <!-- Champ Password sécurisé -->
            <div class="form-group">
                <label for="password">Password</label>  
                <input 
                    id="password"
                    v-model="password" 
                    type="password" 
                    required
                    class="form-control"
                >
            </div>
             <!-- Affichage conditionnel des messages d'erreur -->
            <div v-if="error" class="alert alert-danger">
                {{ error }}
            </div>

            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </form>
    </div>
</template>

<script setup>
// Composition API pour la gestion d'état réactive
import { ref } from 'vue'

// Variables réactives pour le formulaire et les erreurs
const email = ref('')
const password = ref('')
const error = ref('')

/**
 * Gère la soumission du formulaire
 * - Envoie les credentials au backend
 * - Gère la redirection en cas de succès
 * - Affiche les erreurs en cas d'échec
 */
async function handleLogin() {
    try {
        // Appel API avec CSRF protection
        const response = await fetch('/api/v1/authenticate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-XSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            credentials: 'include',
            body: JSON.stringify({
                email: email.value,
                password: password.value
            })
        })

        const data = await response.json()

        // Redirection ou affichage d'erreur selon la réponse
        if (data.status === 'success') {
            window.location.href = data.redirect
        } else {
            error.value = data.message
        }
    } catch (e) {
        error.value = 'An error occurred during login'
    }
}
</script>