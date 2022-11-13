<script setup>

import HeaderNavigation from './components/HeaderNavigation.vue';
import FooterNavigation from './components/FooterNavigation.vue';

</script>

<template>
  <header class="container-fluid">
    <h1 class="text-center my-3">
      Hello Vue Shop 2
    </h1>
    <HeaderNavigation />
  </header>

  <main class="container">
    <RouterView />
  </main>

  <footer class="container-fluid">
    <FooterNavigation />
  </footer>
</template>
