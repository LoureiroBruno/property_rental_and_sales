<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-6">
        <!-- IMAGENS -->
        <Box v-if="listing?.images?.length" class="md:col-span-7">
            <div class="grid grid-cols-2 gap-2">
                <img v-for="image in listing.images" :key="image.id" :src="getImageUrl(image.src)" alt="Listing image"
                    class="w-full h-48 object-cover rounded shadow hover:scale-105 transition-transform duration-200" />
            </div>
        </Box>
        <EmptyState v-else class="md:col-span-7 flex items-center justify-center h-48 text-gray-400">
            No images here
        </EmptyState>

        <!-- INFORMAÇÕES -->
        <div class="md:col-span-5 flex flex-col gap-6">
            <!-- Box: Basic Info -->
            <Box>
                <template #header>Basic info</template>
                <Price :price="listing.price" class="text-2xl font-bold text-green-600 dark:text-green-400" />
                <ListingSpace :listing="listing" class="text-lg mt-1" />
                <ListingAddress :listing="listing" class="text-gray-500 text-sm" />
            </Box>

            <!-- Box: Pagamento Mensal -->
            <Box>
                <template #header>Monthly Payment</template>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Interest rate ({{ interestRate }}%)
                        </label>
                        <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                            class="w-full h-3 rounded-lg appearance-none cursor-pointer bg-gray-300 dark:bg-gray-700 focus:ring-2" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Duration ({{ duration }} years)
                        </label>
                        <input v-model.number="duration" type="range" min="3" max="35" step="1"
                            class="w-full h-3 rounded-lg appearance-none cursor-pointer bg-gray-300 dark:bg-gray-700 focus:ring-2" />
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                        <div class="text-gray-500 dark:text-gray-300 text-sm">Your monthly payment</div>
                        <Price :price="monthlyPayment"
                            class="text-3xl font-semibold text-blue-600 dark:text-blue-400" />
                    </div>

                    <div
                        class="text-sm text-gray-600 dark:text-gray-300 space-y-1 border-t border-gray-200 dark:border-gray-700 pt-3">
                        <div class="flex justify-between">
                            <span>Total paid</span>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <span>Principal paid</span>
                            <Price :price="listing.price" class="font-medium" />
                        </div>
                        <div class="flex justify-between">
                            <span>Interest paid</span>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>

            <!-- OFERTAS -->
            <MakeOffer v-if="user && !offerMade" :listing-id="listing.id" :price="listing.price"
                @offer-updated="offer = $event" />
            <OfferMade v-if="user && offerMade" :offer="offerMade" />
        </div>
    </div>
</template>


<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import MakeOffer from '@/Pages/Listing/Show/Components/MakeOffer.vue'
import { ref } from 'vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import OfferMade from './Show/Components/OfferMade.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
    listing: Object,
    offerMade: Object,
})

const offer = ref(props.listing.price)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer, interestRate, duration,
)

const page = usePage()
const user = computed(() => page.props.user)

// Corrigir URL da imagem
// const getImageUrl = (src) => {
//     if (!src) return ''
//     // Se já começar com http ou /storage, usa direto
//     if (src.startsWith('http') || src.startsWith('/storage')) return src
//     // Adiciona prefixo /storage
//     return `/storage/${src}`
// }

const getImageUrl = (src) => {
    if (!src) return ''
    if (src.startsWith('http')) return src
    return `http://localhost:8084/storage/images/${src}`
}
</script>
