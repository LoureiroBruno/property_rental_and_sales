<template>
  <header
    class="sticky top-0 z-50 mb-12 border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800 w-full mt-2">
    <div class="container mx-auto">
      <nav class="p-4 flex flex-wrap items-center justify-between gap-4 md:flex-nowrap">
        <div v-if="user">
          <div class="relative flex items-center gap-2 text-lg font-medium text-slate-100">
            <Link :href="route('listing.index')"
              class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
            <Squares2X2Icon class="w-6 h-6" />
            Listings
            </Link>
            <Link :href="route('listing.create')"
              class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
            <PlusIcon class="w-6 h-6" />
            New Listing
            </Link>
          </div>
        </div>
        <!-- Centro -->
        <div class="flex-1 text-center font-bold text-xl text-gray-800 dark:text-gray-200">
          <Link :href="route('listing.index')">Property Rental and Sales</Link>
        </div>

        <!-- Direita -->
        <div v-if="user" class="relative flex items-center gap-6">

          <div class="relative" id="user-menu">
            <button @click="toggleDropdown" class="flex items-center gap-2 px-4 py-2  bg-stone-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 
              rounded-md shadow-lg z-50 overflow-hidden">
              <ListBulletIcon class="w-6 h-6" />
              <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                {{ user.name }}
              </span>
              <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
            <!-- Dropdown -->
            <div v-if="open" class="absolute right-0 mt-2 w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 
              rounded-md shadow-lg z-50 overflow-hidden">

              <!-- Dark/Light Mode Toggle Button -->
              <button @click="toggleTheme"
                class="w-full flex items-center justify-center gap-1 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                <component :is="isDark ? SunIcon : MoonIcon" :class="isDark ? 'w-8 h-7' : 'w-8 h-6'" />
                <span>{{ isDark ? 'Clear mode' : 'Dark mode' }}</span>
              </button>

              <!-- Divider -->
              <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>

              <!-- Edit Profile Button -->
              <button
                class="w-full flex items-center justify-center gap-1 px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                <PencilSquareIcon class="w-8 h-6" />
                <span>Edit Profile</span>
              </button>

              <!-- Divider -->
              <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>
              <!-- Logout Button -->
              <Link :href="route('logout')" method="delete" as="button"
                class="w-full flex items-center justify-center gap-1 px-4 py-2 text-sm text-white bg-[indianred] hover:bg-[firebrick] transition">
              <ArrowLeftOnRectangleIcon class="w-8 h-6" />
              <span>Logout</span>
              </Link>
            </div>

          </div>

        </div>
      </nav>
    </div>
  </header>

  <main class="container mx-auto p-4 w-full">

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
// Vue core
import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue'

// Inertia
import { Link, usePage } from '@inertiajs/vue3'

// Heroicons - Solid
import {
  Squares2X2Icon,
  XMarkIcon,
  PencilSquareIcon,
  SunIcon,
  MoonIcon,
  PlusIcon,
  ListBulletIcon,
  ArrowLeftOnRectangleIcon
} from '@heroicons/vue/24/solid'

/* We catch the flashes reactively */
const page = usePage()
const flash = computed(
  () => page.props.flash
)

/* authenticated user information */
const user = computed(
  () => page.props.user,
)

/* dark or light mode */
const isDark = ref(false)
onMounted(() => {
  isDark.value = document.documentElement.classList.contains('dark')
})

const toggleTheme = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark', isDark.value)
}

/* dropdown */
const open = ref(false)

const toggleDropdown = () => {
  open.value = !open.value
}

const closeDropdown = (event) => {
  if (!event.target.closest('#user-menu')) {
    open.value = false
  }
}

onMounted(() => {
  window.addEventListener('click', closeDropdown)
})

onBeforeUnmount(() => {
  window.removeEventListener('click', closeDropdown)
})

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