<template>
  <Link href="/listing">Listings</Link>&nbsp;
  <Link href="/listing/create">New Listing</Link>

  <div v-if="flash.success" class="alert alert-success"> <!--  if not empty it displays the message -->
    {{ flash.success }}
  </div>

  <div v-if="flash.error" class="alert alert-danger">
    {{ flash.error }}
  </div>

  <slot>Default</slot>
</template>

<script setup>
import { computed } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

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