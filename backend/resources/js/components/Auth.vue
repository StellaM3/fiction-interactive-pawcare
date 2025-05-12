<template>
    <div class="login-form">
        <form @submit.prevent="handleLogin">
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
import { ref } from 'vue'

const email = ref('')
const password = ref('')
const error = ref('')

async function handleLogin() {
    try {
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