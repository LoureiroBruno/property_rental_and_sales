<template>
    <Box class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
        <template #header>
            Offer #{{ offer.id }}
            <span v-if="offer.accepted_at" class="ml-2 px-2 py-1 text-xs font-semibold rounded-md
               bg-green-200 text-green-900
               dark:bg-green-900 dark:text-green-200 uppercase">
                accepted
            </span>
        </template>

        <section class="flex flex-col md:flex-row items-center justify-between gap-4">
            <div>
                <Price :price="offer.amount" class="text-2xl font-bold text-gray-900 dark:text-gray-100" />

                <div class="text-gray-600 dark:text-gray-400 mt-1">
                    Difference
                    <Price :price="difference" />
                </div>

                <div class="text-gray-500 dark:text-gray-400 text-sm mt-2">
                    Made by <span class="font-medium text-gray-700 dark:text-gray-300">{{ offer.bidder.name }}</span>
                </div>

                <div class="text-gray-500 dark:text-gray-400 text-sm">
                    Made on <span class="font-medium text-gray-700 dark:text-gray-300">{{ madeOn }}</span>
                </div>
            </div>

            <div>
                <Link v-if="!isSold" :href="route('realtor.offer.accept', { offer: offer.id })" as="button" method="put"
                    class="inline-block px-4 py-2 border border-blue-600 rounded-md
                 text-blue-600 font-semibold text-xs
                 hover:bg-blue-600 hover:text-white transition-colors">
                Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    isSold: Boolean,
})

const difference = computed(() => props.offer.amount - props.listingPrice)
const madeOn = computed(() => new Date(props.offer.created_at).toLocaleDateString())
</script>
