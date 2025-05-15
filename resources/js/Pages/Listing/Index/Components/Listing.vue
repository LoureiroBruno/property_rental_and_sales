<template>
    <Box>
        <div class="relative group">
            <div class="relative group">
                <Link :href="route('listing.show', { listing: listing.id })">
                <div class="flex items-center gap-1">
                    <Price :price="listing.price" class="text-2xl font-bold" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" /> pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
                </Link>
                <Tooltip text="Click to view price, space, address, and full property information" position="top" />
            </div>
        </div>
        <div class="mt-4 flex gap-2">

            <Link :href="route('listing.edit', { listing: listing.id })"
                class="btn-sky flex items-center gap-1 px-4 py-1 text-sm  rounded">
            <PencilSquareIcon class="w-4 h-6" />
            Edit
            </Link>

            <button @click="confirmDelete('listing.destroy', { listing: listing.id })"
                class="btn-indianred flex items-center gap-1 px-4 py-1 text-sm  rounded">
                <TrashIcon class="w-4 h-6" />
                Delete
            </button>

        </div>
    </Box>
</template>

<script setup>
import Tooltip from '@/Components/UI/Tooltip.vue'
import { Link } from '@inertiajs/vue3'
import ListingAddress from '@/Components/ListingAddress.vue'
import Box from '@/Components/UI/Box.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { useConfirmDelete } from '@/Composables/useConfirmDelete'
import { PencilSquareIcon, TrashIcon } from '@heroicons/vue/24/solid'

const { confirmDelete } = useConfirmDelete()
const props = defineProps({ listing: Object })
const { monthlyPayment } = useMonthlyPayment(
    props.listing.price, 2.5, 25,
)
</script>