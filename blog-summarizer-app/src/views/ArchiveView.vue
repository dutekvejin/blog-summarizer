<script setup lang="ts">
import ArticleSummary from '@/components/ArticleSummary.vue'
import LoadingSpinner from '@/components/LoadingSpinner.vue'
import useAxios from '@/integrations/useAxios'
import type { Article } from '@/models/article'
import { useIntersectionObserver } from '@vueuse/core'
import { onMounted, ref } from 'vue'

const articles = ref<Article[]>([])

const { execute: fetchArticles, isLoading } = useAxios(
  '/api/articles',
  { method: 'GET' },
  { immediate: false },
)

const target = ref<HTMLElement | null>(null)
const hasMore = ref(true)

const fetchMore = async () => {
  const numArticles = articles.value.length
  const before = numArticles > 0 ? articles.value[numArticles - 1].createdAt : null
  const limit = 5

  const { data } = await fetchArticles({ params: { before, limit } })
  const newArticles = data.value as Article[]

  articles.value.push(...newArticles)

  hasMore.value = newArticles.length === limit
}

useIntersectionObserver(target, async ([{ isIntersecting }]) => {
  if (!isLoading.value && isIntersecting && hasMore.value) {
    await fetchMore()
  }
})

onMounted(async () => {
  await fetchMore()
})
</script>

<template>
  <ArticleSummary v-for="(article, index) in articles" :key="index" :article="article" />

  <div ref="target" class="py-10">
    <LoadingSpinner v-if="isLoading" class="size-8" />
    <p v-else-if="!hasMore && articles.length > 0" class="text-base text-neutral-300">
      No more articles
    </p>
    <p v-else-if="!hasMore" class="text-base text-neutral-400">
      No articles in your archive.
      <router-link to="/" class="text-violet-400">Start by adding one</router-link>!
    </p>
  </div>
</template>
