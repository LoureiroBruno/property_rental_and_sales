<template>
    <div class="flex justify-end mt-2 mb-4 pr-4">
        <button @click="toggleTheme"
            class="relative w-16 h-10 bg-gray-300 dark:bg-gray-600 rounded-full transition-colors duration-300 focus:outline-none">
            <span
                class="absolute top-1 left-1 w-8 h-8 bg-white rounded-full shadow-md transform transition-transform duration-300"
                :class="{ 'translate-x-6': isDark }"></span>

            <span class="absolute inset-y-0 left-1 flex items-center justify-center w-1/2 text-yellow-600 text-2xl"
                v-if="!isDark">🌞</span>

            <span class="absolute inset-y-0 right-0 flex items-center justify-center w-1/2 text-gray-200 text-2xl"
                v-else>🌙</span>
        </button>
    </div>
</template>


<script setup>
import { ref, onMounted } from 'vue'

const isDark = ref(false)

const toggleTheme = () => {
    isDark.value = !isDark.value
    const html = document.documentElement

    if (isDark.value) {
        html.classList.add('dark')
        localStorage.setItem('theme', 'dark')
    } else {
        html.classList.remove('dark')
        localStorage.setItem('theme', 'light')
    }
}

onMounted(() => {
    const savedTheme = localStorage.getItem('theme')
    if (savedTheme === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
    }
})
</script>
