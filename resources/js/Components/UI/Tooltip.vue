<template>
  <span class="absolute z-10 bottom-full mb-0 left-0 whitespace-normal min-w-[10rem] text-center opacity-0 group-hover:opacity-100
     bg-gray-700 text-white text-xs rounded px-3 py-1 shadow-lg transition">
    {{ text }}
  </span>

</template>

<script setup>
defineProps({
  text: {
    type: String,
    required: true
  }
})
</script>
