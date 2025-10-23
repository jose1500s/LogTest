<script setup>
import { useRouter } from 'vue-router';
import api from '../../lib/axios.js';

const router = useRouter();

async function logout() {
  try {
    // intenta revocar en servidor (si el token ya expiró, puede fallar y no pasa nada)
    await api.post('/api/logout');
  } catch (_) {
    // silencio: si 401/419, igual seguimos con cleanup local 
  } finally {
    // cleanup cliente
    localStorage.removeItem('token');
    // si seteas Authorization por defecto, límpialo:
    // delete api.defaults.headers.common.Authorization;
    router.push({ name: 'login' });
  }
}
</script>

<template>
    <div>
        <h1>Dashboard</h1>
        <p>Bienvenido al panel de control.</p>
        <button @click="logout">Cerrar Sesión</button>
    </div>
</template>