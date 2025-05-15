<template>
  <span :class="[
    baseClasses,
    positionClasses[position]
  ]">
    {{ text }}
  </span>
</template>

<script setup>
defineProps({
  text: {
    type: String,
    required: true
  },
  position: {
    type: String,
    default: 'top', // opções: top, bottom, left, right
    validator: value => ['top', 'bottom', 'left', 'right'].includes(value)
  }
})

const baseClasses = `
  absolute z-10 whitespace-normal min-w-[10rem] text-center opacity-0
  group-hover:opacity-100 bg-gray-700 text-white text-xs rounded px-3 py-1
  shadow-lg transition
`

const positionClasses = {
  top: 'bottom-full mb-1 left-1/2 transform -translate-x-1/2',
  bottom: 'top-full mt-1 left-1/2 transform -translate-x-1/2',
  left: 'right-full mr-1 top-1/2 transform -translate-y-1/2',
  right: 'left-full ml-1 top-1/2 transform -translate-y-1/2'
}
</script>
