<script setup lang="ts">
import { nextTick, onMounted, ref, useTemplateRef } from 'vue'
import useAxios from '@/integrations/useAxios'
import ArticleSummary from '@/components/ArticleSummary.vue'
import { onKeyStroke } from '@vueuse/core'
import LoadingSpinner from '@/components/LoadingSpinner.vue'
import { isEmpty, isURL } from 'validator'

const url = ref('')
const input = useTemplateRef('input')

const {
  execute: generateArticleSummary,
  data: article,
  isLoading,
  isFinished,
} = useAxios('/api/articles', { method: 'POST' }, { immediate: false })

const focusInput = () => nextTick(() => input.value?.focus())

const newSummary = () => {
  url.value = ''
  article.value = null
  isFinished.value = false
  isLoading.value = false

  focusInput()
}

onMounted(() => {
  focusInput()
})

onKeyStroke('Backspace', () => {
  if (isFinished.value) {
    newSummary()
  }
})
</script>

<template>
  <div v-if="!article && !isLoading && !isFinished" class="w-full">
    <input
      ref="input"
      v-model="url"
      @keyup.enter.prevent="isURL(url) ? generateArticleSummary({ data: { url } }) : null"
      type="text"
      class="w-full p-6 bg-white placeholder-neutral-300 rounded-md shadow-md outline-none"
      placeholder="Enter a URL to generate a quick AI-powered summary"
      spellcheck="false"
    />

    <div v-if="isURL(url) && !isEmpty(url)" class="p-4 text-xs text-neutral-400">
      <span class="inline-block px-1.5 bg-neutral-200 text-neutral-500 rounded-sm">⏎</span> to
      generate a summary
    </div>

    <div v-if="!isURL(url) && !isEmpty(url)" class="p-4 text-xs text-red-400">
      <span class="inline-block px-1.5">⚠</span> Not a valid URL
    </div>
  </div>

  <div v-if="isLoading" class="w-full p-6 bg-white rounded-sm shadow-md">
    <div class="flex items-center text-neutral-400">
      <LoadingSpinner class="size-3 me-1.5" /> Generating summary
    </div>
    <div class="pt-4">
      <span class="text-neutral-500">{{ url }}</span>
    </div>
  </div>

  <div v-if="isFinished" class="w-full">
    <ArticleSummary v-if="article" :article="article">
      <template #header>
        <div class="flex pb-4 items-center">
          <span class="me-1.5 text-green-400">✓</span>
          <span class="text-neutral-400">Done</span>
        </div>
      </template>
    </ArticleSummary>
    <div v-else class="w-full p-6 bg-white rounded-sm shadow-md">
      <div class="flex items-center text-neutral-400">
        <span class="me-1.5 text-red-400">✗</span> Error generating summary
      </div>
      <div class="pt-4">
        <span class="text-neutral-500">{{ url }}</span>
      </div>
    </div>

    <div class="p-4 text-xs text-neutral-400">
      <span class="inline-block px-1.5 bg-neutral-200 text-neutral-500 rounded-sm">⌫</span> to enter
      a new URL
    </div>
  </div>
</template>
