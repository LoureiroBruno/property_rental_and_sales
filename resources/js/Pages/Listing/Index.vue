<template>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        <Box v-for="listing in listings" :key="listing.id">
            <div>
                <Link :href="route('listing.show', { listing: listing.id })">
                <Price :price="listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
                </Link>
            </div>

            <div class="mt-4 flex gap-2">
                <Link :href="route('listing.edit', { listing: listing.id })"
                    class="flex items-center gap-1 px-4 py-1 text-sm bg-sky-500 text-white rounded hover:bg-sky-800 transition">
                <PencilSquareIcon class="w-4 h-4" />
                Edit
                </Link>

                <button @click="confirmDelete('listing.destroy', { listing: listing.id })"
                    class="flex items-center gap-1 px-2 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-800 transition">
                    <TrashIcon class="w-4 h-4" />
                    Delete
                </button>
            </div>

        </Box>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import { useConfirmDelete } from '@/Composables/useConfirmDelete'
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid'
defineProps({
    listings: Array,
})

const { confirmDelete } = useConfirmDelete()
</script>