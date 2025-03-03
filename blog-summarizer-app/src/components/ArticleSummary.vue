<script setup lang="ts">
import type { Article } from '@/models/article'

defineProps<{
  article: Article
}>()
</script>

<template>
  <div class="w-full p-6 bg-white rounded-sm shadow-md">
    <slot name="header" class="pb-4" />

    <p class="text-base">{{ article.summary }}</p>
    <div class="pt-4">
      <a
        :href="article.url"
        target="_blank"
        class="text-violet-300 hover:text-violet-400 hover:underline"
        >{{ article.title }}</a
      >
    </div>
  </div>
</template>
