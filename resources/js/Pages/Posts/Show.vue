<script setup lang="ts">
interface Post {
  id: number
  title: string
  slug: string
  excerpt: string | null
  body: string
  coverUrl: string | null
  published_at: string | null
}

const props = defineProps<{ post: Post }>()

function fmt(dt: string | null) {
  return dt ? new Date(dt).toLocaleString() : ''
}
</script>

<template>
  <article class="max-w-3xl mx-auto p-6">
    <a href="/posts" class="text-sm underline">← Back</a>

    <h1 class="mt-2 text-3xl font-bold">{{ props.post.title }}</h1>
    <p class="text-gray-600" v-if="props.post.published_at">
      Published: {{ fmt(props.post.published_at) }}
    </p>

    <img
      v-if="props.post.coverUrl"
      :src="props.post.coverUrl"
      alt=""
      class="mt-4 rounded"
    />

    <div class="prose mt-6 whitespace-pre-wrap">
      {{ props.post.body }}
    </div>
  </article>
</template>
