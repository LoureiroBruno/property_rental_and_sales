<template>
    <h1 class="text-3xl mb-4 label">Your Listings</h1>

    <section>
        <RealtorFilters :filters="filters" />
    </section>

    <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{ 'border-dashed': listing.deleted_at }">
            <div class="flex flex-col md:flex-row gap-2 md:items-start justify-between">
                <!-- content main -->
                <div :class="{ 'opacity-25': listing.deleted_at }" class="flex-1 space-y-1">
                    <div v-if="listing.sold_at != null"
                        class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2">
                        Sold
                    </div>

                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>

                    <ListingAddress :listing="listing" />
                </div>

                <!-- buttons -->
                <div class="flex flex-col gap-3 md:items-end md:w-64">
                    <!-- Ações principais -->
                    <div class="flex flex-wrap gap-2 justify-center md:justify-end w-full">
                        <template v-if="!listing.deleted_at">
                            <!-- Preview - cinza -->
                            <a :href="route('listing.show', { listing: listing.id })" class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border 
        text-teal-600 border-teal-400 hover:bg-teal-100 
        dark:text-teal-300 dark:border-teal-600 dark:hover:bg-teal-800 transition">
                                <i class="fas fa-eye"></i> Preview
                            </a>

                            <!-- Edit - azul -->
                            <Link :href="route('realtor.listing.edit', { listing: listing.id })" class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border 
        text-sky-600 border-sky-400 hover:bg-sky-100 
        dark:text-sky-400 dark:border-sky-500 dark:hover:bg-sky-900 transition">
                            <i class="fas fa-pen"></i> Edit
                            </Link>

                            <!-- Delete - vermelho -->
                            <button @click="confirmDelete('realtor.listing.destroy', { listing: listing.id })"
                                class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border text-red-600 border-red-400 hover:bg-red-100 transition">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </template>

                        <!-- Restore - quando deletado -->
                        <Link v-else :href="route('realtor.listing.restore', { listing: listing.id })" as="button"
                            method="put"
                            class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border text-rose-600 border-rose-400 hover:bg-rose-100 transition">
                        <i class="fas fa-undo-alt"></i> Restore
                        </Link>
                    </div>
                    <!-- Imagens e Ofertas -->
                    <template v-if="!listing.deleted_at">
                        <div class="flex flex-wrap gap-2">
                            <Link :href="route('realtor.listing.image.create', { listing: listing.id })" class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border 
        text-gray-600 border-gray-400 hover:bg-gray-100 
        dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-800 transition">
                            <i class="fas fa-image"></i> Images ({{ listing.images_count }})
                            </Link>

                            <Link :href="route('realtor.listing.show', { listing: listing.id })" class="text-xs inline-flex items-center gap-1 font-medium px-3 py-1 rounded border 
        text-gray-600 border-gray-400 hover:bg-gray-100 
        dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-800 transition">
                            <i class="fas fa-handshake"></i> Offers ({{ listing.offers_count }})
                            </Link>
                        </div>
                    </template>
                </div>
            </div>
        </Box>
    </section>

    <EmptyState v-else>No listings yet</EmptyState>

    <section v-if="listings.data.length"
        class="flex justify-center mt-8  border rounded-xl p-4 bg-gray-200 shadow-sm mb-6 dark:bg-gray-900 dark:border-gray-700">
        <Pagination :links="listings.links" />
    </section>
</template>

<script setup>
import { useConfirmDelete } from '@/Composables/useConfirmDelete.js'
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/vue3'
import '@fortawesome/fontawesome-free/css/all.min.css'

defineProps({
    listings: Object,
    filters: Object,
})

const { confirmDelete } = useConfirmDelete()
</script>
