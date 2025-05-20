<template>
    <div class="mb-6">
        <Link :href="route('realtor.listing.index')" class="inline-flex items-center px-4 py-2 border border-slate-400 rounded-lg
             text-slate-600 hover:text-slate-800
             dark:text-slate-300 dark:border-slate-600 dark:hover:text-white
             font-semibold transition-colors">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" viewBox="0 0 24 24">
            <path d="M15 18l-6-6 6-6" />
        </svg>
        Go back to Listings
        </Link>
    </div>

    <section class="flex flex-col-reverse md:grid md:grid-cols-12 gap-6">
        <Box v-if="!hasOffers"
            class="flex md:col-span-7 items-center justify-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow">
            <div class="w-full text-center font-medium text-gray-400 dark:text-gray-500 text-lg">
                No offers
            </div>
        </Box>

        <div v-else class="md:col-span-7 flex flex-col gap-5">
            <Offer v-for="offer in listing.offers" :key="offer.id" :offer="offer" :listing-price="listing.price"
                :is-sold="listing.sold_at != null" />
        </div>

        <div class="md:col-span-5">
            <Box class="bg-white dark:bg-gray-900 rounded-lg shadow p-6">
                <template #header>
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-gray-300">Basic Info</h2>
                </template>

                <Price :price="listing.price" class="text-3xl font-extrabold text-green-600 dark:text-green-400 my-3" />

                <ListingSpace :listing="listing" class="text-lg text-gray-700 dark:text-gray-300 mb-2" />
                <ListingAddress :listing="listing" class="text-gray-500 dark:text-gray-400 text-sm" />
            </Box>
        </div>
    </section>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/vue3'
import { computed } from 'vue'
import Offer from '@/Pages/Realtor/Show/Components/Offer.vue'

const props = defineProps({ listing: Object })

const hasOffers = computed(() => props.listing.offers.length)
</script>
