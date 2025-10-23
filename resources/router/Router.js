import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/Auth/Login.vue';
import Register from '../components/Auth/Register.vue';
import Dashboard from '../components/Dashboard/main.vue';

const routes = [
  { path: '/', redirect: '/login' },
  { path: '/login', name: 'login', component: Login, meta: { guest: true } },
  { path: '/register', name: 'register', component: Register, meta: { guest: true } },
  {path: '/dashboard', name: 'dashboard', component: Dashboard, meta: { requiresAuth: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token')

    // Si la ruta requiere auth y no hay token entonces se redirige al login
    if (to.meta.requiresAuth && !token) {
        next({ name: 'login' })
    }
    // Si la ruta es solo para invitados (login/register) y ya hay token se redirige al dashboard
    else if (to.meta.guest && token) {
        next({ name: 'dashboard' })
    }
    else {
        next()
    }
})

export default router;


