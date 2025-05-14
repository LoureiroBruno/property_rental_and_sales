<template>
  <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 w-full">
    <div class="container mx-auto">
      <nav class="p-4 flex flex-wrap items-center justify-between gap-4 md:flex-nowrap">
        <div class="group relative flex items-center gap-2 text-lg font-medium text-slate-100">
          <Squares2X2Icon
            class="w-6 h-6 text-slate-800 dark:text-slate-200 hover:text-slate-600 dark:hover:text-slate-400 transition" />
          <Link :href="route('listing.index')"
            class="hover:underline transition text-slate-800 dark:text-slate-200 hover:text-slate-600 dark:hover:text-slate-400">
          Listings
          </Link>

          <!-- Tooltip -->
          <span
            class="absolute z-10 top-full mt-2 left-1/2 -translate-x-1/2 whitespace-normal min-w-[10rem] text-center opacity-0 group-hover:opacity-100 bg-gray-700 text-white text-xs rounded px-3 py-1 shadow-lg transition">
            See all boxes
          </span>
        </div>

        <div class="flex-1 text-center text-xl font-bold text-gray-600 dark:text-gray-300">
          <Link :href="route('listing.index')">Property Rental and Sales</Link>
        </div>
        <div>
          <Link :href="route('listing.create')" class="btn-primary">+ New Listing</Link>
        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4">

    <ThemeToggle />

    <div v-if="flash.success"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2 relative">
      <button @click="closeMessage('success')" class="absolute top-2 right-2 text-lg text-green-600">
        <XMarkIcon class="w-8 h-7" />
      </button>
      {{ flash.success }}
    </div>

    <div v-if="flash.error"
      class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2 relative">
      <button @click="closeMessage('error')" class="absolute top-2 right-2 text-lg text-red-600"> ✖ </button>
      {{ flash.error }}
    </div>

    <slot>Default</slot>
  </main>
</template>

<script setup>
import { computed, ref, watch } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import { Squares2X2Icon, XMarkIcon } from '@heroicons/vue/24/solid'
import ThemeToggle from '@/Components/UI/ThemeToggle.vue'

// We catch the flashes reactively
const page = usePage()
const flash = computed(() => page.props.flash)

const successTimeout = ref(null)
const errorTimeout = ref(null)

/*
  As soon as flash.success or flash.error receives a value (message), a setTimeout is triggered.
  After 3 seconds (3000 ms), the message will be automatically closed.
  If the user clicks before, the clearTimeout ensures that the timeout is cancelled
  and no more attempts are made to close it.
*/

const closeMessage = (type) => {
  flash.value[type] = ''
  clearTimeout(type === 'success' ? successTimeout.value : errorTimeout.value)
}

watch(() => flash.value.success, (newValue) => {
  if (newValue) {
    clearTimeout(successTimeout.value)
    successTimeout.value = setTimeout(() => {
      closeMessage('success')
    }, 3000)
  }
})

watch(() => flash.value.error, (newValue) => {
  if (newValue) {
    clearTimeout(errorTimeout.value)
    errorTimeout.value = setTimeout(() => {
      closeMessage('error')
    }, 3000)
  }
})
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