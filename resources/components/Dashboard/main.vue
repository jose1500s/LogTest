<script setup>
import { useRouter } from 'vue-router';
import api from '../../lib/axios.js';

const router = useRouter();

async function logout() {
  try {
    await api.post('/api/logout');
  } catch (_) {
  } finally {
    localStorage.removeItem('token');
    router.push({ name: 'login' });
  }
}
</script>

<template>
    <div>
        <h1>Dashboard</h1>
        <p>Bienvenido al panel de control.</p>
        <button 
        @click="logout"
        class="btn btn-outline-primary"
        >
            Cerrar Sesión
         </button>
    </div>
</template>