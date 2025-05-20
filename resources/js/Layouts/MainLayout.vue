<template>
  <header
    class="sticky top-0 z-50 mb-1 w-full border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800">
    <div class="container mx-auto">
      <nav class="p-4 flex flex-wrap items-center justify-between gap-4 md:flex-nowrap">
        <div v-if="user" class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full px-4">
          <div class="flex items-center gap-4 text-lg font-medium text-slate-100">
            <Link :href="route('listing.index')"
              class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
            <Squares2X2Icon class="w-6 h-6" />
            Listings
            </Link>

            <Link :href="route('realtor.listing.create')"
              class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
            <PlusIcon class="w-6 h-6" />
            New Listing
            </Link>
          </div>

          <div class="flex-1 text-center font-bold text-xl text-gray-800 dark:text-gray-200">
            <Link :href="route('listing.index')">Property Rental and Sales</Link>
          </div>

          <Link class="text-gray-500 relative pr-2 py-2 text-lg" :href="route('notification.index')">
          🔔
          <div v-if="notificationCount"
            class="absolute right-0 top-0 w-5 h-5 bg-red-700 dark:bg-red-400 text-white font-medium border border-white dark:border-gray-900 rounded-full text-xs text-center">
            {{ notificationCount }}
          </div>
          <span>Notifications</span>
          </Link>

          <div class="relative flex items-center gap-6">

            <div id="user-menu" class="relative">
              <button @click="toggleDropdown"
                class="flex items-center gap-2 px-4 py-2 bg-stone-100 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50 overflow-hidden">
                <ListBulletIcon class="w-6 h-6" />
                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ user.name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <!-- Dropdown Menu -->
              <div v-if="open"
                class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-md shadow-lg z-50 overflow-hidden">
                <div id="tester" class="w-full justify-center">

                  <!-- Dark / Light Mode Toggle -->
                  <button @click="toggleTheme(); closeDropdownClick()"
                    class="w-full flex items-center justify-start gap-1 px-4 py-2 pl-8 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800">
                    <component :is="isDark ? SunIcon : MoonIcon" :class="isDark ? 'w-8 h-7' : 'w-8 h-6'" />
                    <span>{{ isDark ? 'Switch to Light Mode' : 'Switch to Dark Mode' }}</span>
                  </button>

                  <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>

                  <Link :href="route('user-account.edit')"
                    class="w-full flex items-center justify-start gap-1 px-4 py-2 pl-8 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
                    @click="closeDropdownClick">
                  <UserCircleIcon class="w-8 h-6" />
                  <span>My Access Profile</span>
                  </Link>

                  <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>

                  <!-- Realtor Profile Link -->
                  <Link :href="route('realtor.listing.index')"
                    class="w-full flex items-center justify-start gap-1 px-4 py-2 pl-8 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800"
                    @click="closeDropdownClick">
                  <BuildingOfficeIcon class="w-8 h-6" />
                  <span>Real Estate Agent</span>
                  </Link>

                  <div class="h-px bg-gray-200 dark:bg-gray-700 my-1"></div>
                </div>

                <!-- Logout -->
                <Link :href="route('logout')" method="delete" as="button"
                  class="w-full flex items-center justify-center gap-1 px-4 py-2 text-sm text-white bg-[indianred] hover:bg-[firebrick] transition">
                <ArrowLeftOnRectangleIcon class="w-8 h-6" />
                <span>Logout</span>
                </Link>
              </div>
            </div>
          </div>
        </div>


        <div v-else class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full px-4">
          <div
            class="flex items-center gap-2 text-lg font-medium text-slate-900 border border-gray-300 rounded-md px-2 py-1 dark:text-slate-100 dark:border-gray-600">
            <Link :href="route('user-account.create')"
              class="flex items-center gap-2 font-bold text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
            <PlusIcon class="w-6 h-6" />
            Register
            </Link>
          </div>

          <div class="flex-1 text-center font-bold text-xl text-gray-800 dark:text-gray-200">
            <Link :href="route('listing.index')">Property Rental and Sales</Link>
          </div>

          <div class="flex items-center gap-6">
            <Link :href="route('login')" class="btn-primary flex items-center gap-1">
            <ArrowRightOnRectangleIcon class="w-5 h-5" />
            <span>Sign In</span>
            </Link>
          </div>
        </div>
      </nav>
    </div>
  </header>

  <!-- Flash Messages -->
  <main class="container mx-auto p-4 w-full">
    <div v-if="localFlash.success"
      class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2 relative">
      <button @click="closeMessage('success')" class="absolute top-2 right-2 text-lg text-green-600"
        aria-label="Close success message">
        <XMarkIcon class="w-8 h-7" />
      </button>
      {{ localFlash.success }}
    </div>

    <div v-if="localFlash.error"
      class="mb-4 border rounded-md shadow-sm border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900 p-2 relative">
      <button @click="closeMessage('error')" class="absolute top-2 right-2 text-lg text-red-600"
        aria-label="Close error message">
        ✖
      </button>
      {{ localFlash.error }}
    </div>

    <slot>Default</slot>
  </main>
</template>


<script setup>
import { ref, computed, watch, onMounted, onBeforeUnmount } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import {
  Squares2X2Icon,
  XMarkIcon,
  BuildingOfficeIcon,
  SunIcon,
  MoonIcon,
  PlusIcon,
  ListBulletIcon,
  UserCircleIcon,
  ArrowRightOnRectangleIcon,
  ArrowLeftOnRectangleIcon
} from '@heroicons/vue/24/solid'

// --- Dados reativos da página ---
const page = usePage()

// Usuário autenticado
const user = computed(() => page.props.user)

// Flash messages recebidos via props (somente leitura)
const flash = computed(() => page.props.flash)

// --- Controle de tema (dark/light) ---
const isDark = ref(false)
onMounted(() => {
  isDark.value = document.documentElement.classList.contains('dark')
})
const toggleTheme = () => {
  isDark.value = !isDark.value
  document.documentElement.classList.toggle('dark', isDark.value)
}

// --- Dropdown de usuário ---
const open = ref(false)

const toggleDropdown = () => {
  open.value = !open.value
}

// Fecha dropdown ao clicar fora
const closeDropdown = (event) => {
  if (!event.target.closest('#user-menu')) {
    open.value = false
  }
}

function closeDropdownClick() {
  open.value = false;
}

onMounted(() => {
  window.addEventListener('click', closeDropdown)
})
onBeforeUnmount(() => {
  window.removeEventListener('click', closeDropdown)
})

// --- Controle local para mensagens flash (para fechar manual/automaticamente) ---
// Copiamos o conteúdo inicial para estado reativo local, pois flash é computed readonly
const localFlash = ref({
  success: flash.value.success || '',
  error: flash.value.error || '',
})

// Atualiza localFlash ao receber novas mensagens do servidor
watch(flash, (newFlash) => {
  if (newFlash.success) localFlash.value.success = newFlash.success
  if (newFlash.error) localFlash.value.error = newFlash.error
})

// Timeouts para fechar mensagens automaticamente
let successTimeout = null
let errorTimeout = null

const closeMessage = (type) => {
  localFlash.value[type] = ''
  if (type === 'success' && successTimeout) {
    clearTimeout(successTimeout)
    successTimeout = null
  }
  if (type === 'error' && errorTimeout) {
    clearTimeout(errorTimeout)
    errorTimeout = null
  }
}

watch(() => localFlash.value.success, (val) => {
  if (val) {
    if (successTimeout) clearTimeout(successTimeout)
    successTimeout = setTimeout(() => closeMessage('success'), 3000)
  }
})

watch(() => localFlash.value.error, (val) => {
  if (val) {
    if (errorTimeout) clearTimeout(errorTimeout)
    errorTimeout = setTimeout(() => closeMessage('error'), 3000)
  }
})
</script>
