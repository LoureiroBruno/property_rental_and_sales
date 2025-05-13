<template>
  <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex items-center justify-between">
        <div class="text-lg font-medium flex items-center gap-1 text-slate-100 hover:underline">
          <ListBulletIcon class="w-6 h-6" />
          <Link :href="route('listing.index')" class="text-slate-100 hover:underline hover:text-slate-400 transition">
          Listings</Link>
        </div>
        <div class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center">
          <Link :href="route('listing.index')">Property Rental and Sales</Link>
        </div>
        <div>
          <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4">
    <div v-if="flash.success"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
      {{ flash.success }}
    </div>

    <div v-if="flash.error"
      class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2">>
      {{ flash.error }}
    </div>

    <slot>Default</slot>
  </main>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { ListBulletIcon } from '@heroicons/vue/24/solid'

// Pegamos os flashs de forma reativa
const page = usePage()

const flash = computed(() => page.props.flash)
</script>

<style scoped>
.alert-success {
  background-color: green;
  color: white;
  padding: 1em;
  margin-bottom: 1em;
}

.alert-danger {
  background-color: red;
  color: white;
  padding: 1em;
  margin-bottom: 1em;
}
</style>