<script setup lang="ts">
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <div class="max-w-3xl mx-auto py-4">
    <header class="flex flex-col items-center pt-12 pb-8">
      <div class="max-w-3xl mx-auto pb-4 text-xl text-center">
        <router-link to="/" class="flex flex-col items-center justify-center p-2">
          <img src="@/assets/logo.png" class="w-18 inline" />
          <div>
            <span class="text-neutral-600">Summar</span><span class="text-violet-400">AI</span>
          </div>
        </router-link>
      </div>

      <nav class="flex gap-2">
        <RouterLink
          to="/"
          class="px-1.5 py-0.5 rounded-sm text-neutral-600"
          active-class="bg-neutral-300"
          exact
        >
          Generate
        </RouterLink>
        <RouterLink
          to="/archive"
          class="px-1.5 py-0.5 rounded-sm text-neutral-600"
          active-class="bg-neutral-300"
          exact
        >
          Archive
        </RouterLink>
      </nav>
    </header>

    <main class="flex flex-col items-center gap-6 pt-6 pb-4">
      <RouterView />
    </main>
  </div>
</template>
