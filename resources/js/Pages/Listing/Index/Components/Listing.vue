<template>
    <Box
        class="w-full h-full p-4 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 hover:shadow-md transition-shadow bg-white dark:bg-gray-800">
        <div class="flex flex-col justify-between h-full">
            <div class="relative group flex-1">
                <Link :href="route('listing.show', { listing: listing.id })" class="block h-full w-full">
                <div class="mb-3">
                    <div class="flex items-center justify-between mb-1">
                        <Price :price="listing.price" class="text-2xl font-semibold text-gray-800 dark:text-gray-100" />
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <Price :price="monthlyPayment" />
                            <span class="text-xs">/ mês</span>
                        </div>
                    </div>

                    <ListingSpace :listing="listing" class="text-lg text-gray-700 dark:text-gray-300 mb-1" />
                    <ListingAddress :listing="listing" class="text-sm text-gray-500 dark:text-gray-400" />
                </div>
                </Link>

                <Tooltip text="Clique para ver preço, espaço, endereço e detalhes do imóvel" position="top" />
            </div>
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

const { confirmDelete } = useConfirmDelete()
const props = defineProps({ listing: Object })

const { monthlyPayment } = useMonthlyPayment(
    props.listing.price,
    2.5,
    25
)
</script>
