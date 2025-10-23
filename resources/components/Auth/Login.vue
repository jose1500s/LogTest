<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import api from '../../lib/axios.js';
import Input from '../Input.vue';

const router = useRouter();
const email = ref('');
const password = ref('');
const error = ref('');
const loading = ref(false);

async function submit() {
  loading.value = true;
  error.value = '';

  try {
    const { data } = await api.post('/api/login', {
      email: email.value,
      password: password.value,
    });

    localStorage.setItem('token', data.token);
    router.push({ name: 'dashboard' });
  } catch (e) {
    error.value = e.response?.data?.message ?? 'Error al iniciar sesión';
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
      <h2>Iniciar Sesión</h2>
      </div>
      <form @submit.prevent="submit">
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
          Iniciar Sesión
        </button>
        <p v-if="error" class="error">{{ error }}</p>
        <div class="text-center mt-3">
          <p class="mt-2">
            ¿No tienes una cuenta?
            <router-link to="/register">Regístrate aquí</router-link>
          </p>
          <p>
            ¿Olvidaste tu contraseña?
            <router-link to="/">Recupérala aquí</router-link>
          </p>
        </div>

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
p {
  font-size: 14px;
}
a {
  color: #007bff;
  text-decoration: none;
}
a:hover {
  text-decoration: underline;
}
</style>
