<template>
  <div>Index</div>
  <Link href="/hello">Show Page</Link>

  <!-- Display the message passed from Laravel via props -->
  <div>The message is {{ message }}</div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
// Define props with type validation (expects 'message' as a String)
defineProps({
  message: String,
});
</script>

<script>
import MainLayout from "../../Layouts/MainLayout.vue";
export default {
  layout: MainLayout,
};
</script>
