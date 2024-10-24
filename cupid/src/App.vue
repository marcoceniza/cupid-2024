<script setup>
import { RouterLink, RouterView } from 'vue-router';
import { useAuthStore } from '@/stores/authStore';
import { storeToRefs } from 'pinia';

const { user } = storeToRefs(useAuthStore());
const userData = JSON.parse(user.value)
</script>

<!-- #ff8398 -->

<template>
  <header class="bg-[#333] min-h-[45px] leading-[45px]">
    <nav class="container mx-auto flex justify-between">
      <div>
        <RouterLink :to="{ name: 'home' }" class="text-[#fff] hover:underline">Home</RouterLink>
      </div>
      <div class="flex space-x-5">
        <p v-if="userData" class="text-white">{{ userData ? userData.name : 'Naruto' }}</p>
        <p v-else class="text-white">{{ user ? user.name : 'Naruto' }}</p>
      </div>
    </nav>
  </header>

  <RouterView />
</template>
