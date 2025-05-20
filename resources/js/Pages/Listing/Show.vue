<script setup>
import { ref, computed } from 'vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'

import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import MakeOffer from './Show/MakeOffer.vue'   // ← caminho corrigido

// 1) DECLARE props PRIMEIRO
const props = defineProps({
    listing: Object,
    offerMade: Object,
})

// 2) Agora você pode usar props para inicializar refs
const interestRate = ref(2.5)
const duration = ref(25)
const offer = ref(props.listing.price)

// 3) Computeds
const hasImages = computed(() => props.listing?.images?.length)

// 4) Lógica do cálculo de mensalidade
const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer,
    interestRate,
    duration,
)
</script>

<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 items-center" :class="{ 'flex': !hasImages }">
            <div v-if="hasImages" class="grid grid-cols-2 gap-1">
                <img v-for="image in props.listing.images" :key="image.id" :src="image.src" />
            </div>
            <div v-else class="w-full text-center font-medium text-gray-500">
                No images
            </div>
        </Box>

        <div class="md:col-span-5 flex flex-col gap-4">
            <!-- Basic Info -->
            <Box>
                <template #header>Basic Info</template>
                <Price :price="props.listing.price" class="text-2xl font-bold" />
                <ListingSpace :listing="props.listing" class="text-lg" />
                <ListingAddress :listing="props.listing" class="text-gray-500" />
            </Box>

            <!-- Monthly Payment -->
            <Box>
                <template #header>Monthly Payment</template>
                <label class="label">
                    Interest rate ({{ interestRate }}%)
                </label>
                <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1"
                    class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />

                <label class="label">
                    Duration ({{ duration }} years)
                </label>
                <input v-model.number="duration" type="range" min="3" max="35" step="1"
                    class="w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700" />

                <div class="text-gray-600 dark:text-gray-300 mt-2">
                    <div class="text-gray-400">Your monthly payment</div>
                    <Price :price="monthlyPayment" class="text-3xl" />
                </div>

                <div class="mt-2 text-gray-500">
                    <div class="flex justify-between">
                        <div>Total paid</div>
                        <div>
                            <Price :price="totalPaid" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Principal paid</div>
                        <div>
                            <Price :price="props.listing.price" class="font-medium" />
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <div>Interest paid</div>
                        <div>
                            <Price :price="totalInterest" class="font-medium" />
                        </div>
                    </div>
                </div>
            </Box>

            <!-- Make Offer -->
            <MakeOffer :price="props.listing.price" :listing-id="props.listing.id" :offer-made="props.offerMade"
                @offer-updated="offer = $event" />
        </div>
    </div>
</template>
