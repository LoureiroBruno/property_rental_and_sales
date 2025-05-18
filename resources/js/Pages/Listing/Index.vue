<template>
    <section class="px-4 md:px-10 lg:px-18 py-6">
        <div class="mb-8">
            <Filters :filters="filters" />
        </div>

        <div v-if="listings.data.length" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
        </div>

        <div v-else class="text-center text-gray-500 text-lg mt-12">
            No properties found with the selected filters.
        </div>

        <div v-if="listings.data.length"
            class="flex justify-center mt-8  border rounded-xl p-4 bg-gray-200 shadow-sm mb-6 dark:bg-gray-900 dark:border-gray-700">
            <Pagination :links="listings.links" />
        </div>

    </section>
</template>

<script setup>
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Filters from '@/Pages/Listing/Index/Components/Filters.vue'

defineProps({
    listings: Object,
    filters: Object,
})

</script>