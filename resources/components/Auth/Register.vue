<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../lib/axios.js';
import Input from '../Input.vue';

const router = useRouter();
const name = ref('');
const email = ref('');
const password = ref('');
const error = ref('');
const loading = ref(false);

async function submit() {
    loading.value = true;
    error.value = '';
    try {
        const { data } = await api.post('/api/register', { name: name.value, email: email.value, password: password.value });
        localStorage.setItem('token', data.token);
        router.push({ name: 'login' });
        console.log('Registro exitoso');
        console.log(data);
        alert('Registro exitoso, por favor inicia sesión.');
    } catch (e) {
        error.value = e.response?.data?.message ?? 'Error al registrarse';
    } finally {
        loading.value = false;
    }
}

</script>

<template>
  <div id="login">
    <section id="imgDiv">
      <img
        id="imgLogin"
        src="../../../public/images/login.svg"
        alt="login image"
      />
    </section>
    <section id="formDiv">
      <div id="headerLogin">
        <img
        id="imgLogin"
        src="../../../public/images/logo.webp"
        width="150"
        height="150"
        alt="login image"
      />
      <h2>Registrate</h2>
      </div>
      <form @submit.prevent="submit">
        <Input
          label="Nombre Completo"
          type="text"
          placeholder="Tu Nombre"
          v-model="name"
          name="name"
        />
        <Input
          label="Correo Electrónico"
          type="email"
          placeholder="correo@example.com"
          v-model="email"
          name="email"
        />
        <Input
          label="Contraseña"
          type="password"
          placeholder="********"
          v-model="password"
          name="password"
        />
        <button type="submit" class="btn btn-primary w-100">
          Registrarse
        </button>
        <p v-if="error" class="error">{{ error }}</p>
        <p class="mt-2">
          ¿ya tienes una cuenta?
        <router-link to="/">Inicia sesión aquí</router-link>
        </p>

      </form>
    </section>
  </div>
</template>

<style scoped>
.error {
  color: red;
  text-align: center;
  margin-top: 5px;
}
</style>
