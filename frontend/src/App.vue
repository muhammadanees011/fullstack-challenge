<script setup lang="ts">
import { RouterLink, RouterView } from "vue-router";
</script>

<template>
  <header>
    <div class="wrapper">
      <nav>
        <!-- <RouterLink to="/">Home</RouterLink> -->
      </nav>
    </div>
  </header>
  <div class="parent">
    <RouterView />
  </div>
</template>

<style scoped>

</style>
