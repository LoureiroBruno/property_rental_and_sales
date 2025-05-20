<template>
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">Your Notifications</h1>

    <section v-if="notifications.data.length" class="space-y-4">
        <div v-for="notification in notifications.data" :key="notification.id"
            class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm flex justify-between items-center">
            <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                <span v-if="notification.type === 'App\\Notifications\\OfferMade'">
                    Offer
                    <Price :price="notification.data.amount" /> for
                    <Link :href="route('realtor.listing.show', { listing: notification.data.listing_id })"
                        class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">
                    listing
                    </Link>
                    was made.
                </span>
            </div>
            <div>
                <Link v-if="!notification.read_at" :href="route('notification.seen', { notification: notification.id })"
                    as="button" method="put"
                    class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-indigo-600 dark:border-indigo-400 dark:text-indigo-400 rounded-full text-xs font-semibold uppercase hover:bg-indigo-50 dark:hover:bg-indigo-900 transition">
                Mark as read
                </Link>
            </div>
        </div>
    </section>

    <EmptyState v-else>No notifications yet!</EmptyState>

    <section v-if="notifications.data.length"
        class="flex justify-center mt-8  border rounded-xl p-4 bg-gray-200 shadow-sm mb-6 dark:bg-gray-900 dark:border-gray-700">
        <Pagination :links="notifications.links" />
    </section>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
    notifications: Object,
})
</script>
