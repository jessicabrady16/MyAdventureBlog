<script setup lang="ts">
import { reactive } from 'vue'

const csrf =
  (document.querySelector('meta[name="csrf-token"]') as HTMLMetaElement | null)?.content ?? ''

type FormState = {
  title: string
  slug: string
  excerpt: string
  body: string
}

const form = reactive<FormState>({
  title: '',
  slug: '',
  excerpt: '',
  body: '',
})

function onFile(e: Event) {
  // optional: just to satisfy TS if you want to preview, etc.
  const input = e.target as HTMLInputElement
  const _file = input.files?.[0]
  // no-op; native <form> will submit the file via multipart/form-data
}
</script>

<template>
  <div class="max-w-2xl mx-auto p-6 space-y-4">
    <h1 class="text-2xl font-bold">New Post</h1>

    <form method="post" action="/posts" enctype="multipart/form-data" class="space-y-4">
      <input type="hidden" name="_token" :value="csrf" />

      <div>
        <label class="block font-medium">Title</label>
        <input name="title" v-model="form.title" class="border rounded w-full p-2" required />
      </div>

      <div>
        <label class="block font-medium">Slug (optional)</label>
        <input name="slug" v-model="form.slug" class="border rounded w-full p-2" />
      </div>

      <div>
        <label class="block font-medium">Excerpt</label>
        <textarea name="excerpt" v-model="form.excerpt" class="border rounded w-full p-2" />
      </div>

      <div>
        <label class="block font-medium">Body</label>
        <textarea name="body" v-model="form.body" class="border rounded w-full p-2 h-40" required />
      </div>

      <div>
        <label class="block font-medium">Cover image</label>
        <input type="file" name="cover" accept="image/*" @change="onFile" />
      </div>

      <label class="inline-flex items-center gap-2">
        <input type="checkbox" name="published" value="1" />
        <span>Publish now</span>
      </label>

      <div class="pt-2">
        <button class="px-3 py-2 rounded bg-black text-white">Save</button>
      </div>
    </form>
  </div>
</template>
