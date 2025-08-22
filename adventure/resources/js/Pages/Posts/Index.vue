<script setup lang="ts">
interface Link {
  url: string | null
  label: string
  active: boolean
}

interface PostItem {
  id: number
  title: string
  slug: string
  excerpt: string | null
  coverUrl: string | null
  published_at: string | null
}

interface Paginated<T> {
  data: T[]
  links?: Link[]
}

const props = defineProps<{
  posts: Paginated<PostItem>
}>()

function fmt(dt: string | null) {
  return dt ? new Date(dt).toLocaleString() : ''
}
</script>

<template>
  <div class="max-w-3xl mx-auto p-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Posts</h1>
      <a href="/posts/create" class="px-3 py-2 rounded bg-black text-white">New</a>
    </div>

    <div class="mt-6 space-y-6">
      <article v-for="p in props.posts.data" :key="p.id" class="border rounded p-4">
        <h2 class="text-xl font-semibold">
          <a :href="`/posts/${p.id}`">{{ p.title }}</a>
        </h2>
        <p class="text-sm text-gray-600" v-if="p.published_at">Published: {{ fmt(p.published_at) }}</p>
        <p class="mt-2" v-if="p.excerpt">{{ p.excerpt }}</p>
        <img v-if="p.coverUrl" :src="p.coverUrl" alt="" class="mt-3 rounded" />
      </article>
    </div>

    <div class="mt-6" v-if="props.posts.links?.length">
      <nav class="flex gap-2 flex-wrap">
        <a
          v-for="l in props.posts.links"
          :key="l.url ?? l.label"
          :href="l.url || '#'"
          :class="[
            'px-2 py-1 border rounded',
            { 'bg-black text-white': l.active, 'pointer-events-none opacity-50': !l.url }
          ]"
          v-html="l.label"
        />
      </nav>
    </div>
  </div>
</template>
