<template>
  <MainLayout> <!-- Alternatively, use <main-layout> (kebab-case) in templates -->
    <div>Index</div>
    <Link href="/hello">Show Page</Link>

    <!-- Display the message passed from Laravel via props -->
    <div>
      The message is {{ message }}
    </div>
  </MainLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'

// Define props with type validation (expects 'message' as a String)
defineProps({
  message: String
})

// Alternatively, use: defineProps(['message']) — no validation
</script>