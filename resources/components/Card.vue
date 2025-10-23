<script setup>
const { imgPath } = defineProps({
  imgPath: { type: String, default: '' },
});
</script>

<template>
  <section id="img">
    <img v-if="imgPath" :src="imgPath" alt="card image" />
  </section>

  <section>
    <h2>Bienvenido</h2>
  </section>
</template>

<style scoped>
</style>
