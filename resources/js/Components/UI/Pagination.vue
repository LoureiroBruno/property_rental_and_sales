<template>
    <div class="flex gap-1">
        <template v-for="(link, index) in links" :key="index">
            <Link v-if="link.url" :href="link.url" class="py-2 px-4 rounded-md"
                :class="{ 'bg-indigo-500 dark:bg-indigo-800 text-gray-300': link.active }" v-html="link.label" />
            <span v-else class="py-2 px-4 rounded-md text-gray-400 dark:text-gray-600" v-html="link.label" />
        </template>
    </div>
</template>


<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({ links: Array })
</script>