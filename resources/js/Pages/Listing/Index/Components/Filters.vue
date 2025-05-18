<template>
    <form @submit.prevent="filter">
        <div
            class="border rounded-xl p-4 bg-white shadow-sm mb-6 dark:bg-gray-800 dark:border-gray-700 dark:shadow-none">
            <form @submit.prevent="filter">
                <div class="flex justify-start flex-wrap gap-12">
                    <!-- price -->
                    <div class="flex flex-nowrap items-center">
                        <input v-model.number="filterForm.priceFrom" type="number" placeholder="Price from"
                            class="input-filter-l w-28" />
                        <input v-model.number="filterForm.priceTo" type="number" placeholder="Price to"
                            class="input-filter-r w-28" />
                    </div>

                    <!-- beds / baths -->
                    <div class="flex flex-nowrap items-center">
                        <select v-model="filterForm.beds" class="input-filter-l w-28">
                            <option value="">Beds</option>
                            <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                            <option value="6+">6+</option>
                        </select>
                        <select v-model="filterForm.baths" class="input-filter-r w-28">
                            <option value="">Baths</option>
                            <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                            <option value="6+">6+</option>
                        </select>
                    </div>

                    <!-- area -->
                    <div class="flex flex-nowrap items-center">
                        <input v-model.number="filterForm.areaFrom" type="number" placeholder="Area from"
                            class="input-filter-l w-28" />
                        <input v-model.number="filterForm.areaTo" type="number" placeholder="Area to"
                            class="input-filter-r w-28" />
                    </div>

                    <!-- buttons -->
                    <div class="flex items-center gap-4 mt-2">
                        <!-- Botão Filtrar -->
                        <button type="submit" class="btn-normal flex items-center gap-2 px-4 py-2">
                            <FunnelIcon class="w-5 h-6" />
                            <span>Filter</span>
                        </button>

                        <!-- Botão Limpar -->
                        <button type="reset" @click="clear"
                            class="btn-normal flex items-center gap-2 px-4 py-2 bg-gray-200 text-black hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                            <XMarkIcon class="w-5 h-6" />
                            <span>Clear</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </form>
</template>

<script setup>
import { useForm, usePage } from '@inertiajs/vue3'
import { ref, computed, watch } from 'vue'
import { FunnelIcon, XMarkIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    filters: Object,
})

// Inicializa o formulário com os filtros vindos do backend (ou vazios)
const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    beds: props.filters.beds ?? '',
    baths: props.filters.baths ?? '',
    areaFrom: props.filters.areaFrom ?? null,
    areaTo: props.filters.areaTo ?? null,
})

// Guarda o estado inicial para comparar e detectar mudanças
const initialState = ref(JSON.stringify(filterForm))

// Computed para saber se o form foi modificado
const isFormDirty = computed(() => JSON.stringify(filterForm) !== initialState.value)

const filter = () => {
    filterForm.get(route('listing.index'), {
        preserveState: true,
        preserveScroll: true,
    })
}

const clear = () => {
    filterForm.priceFrom = null
    filterForm.priceTo = null
    filterForm.beds = ''
    filterForm.baths = ''
    filterForm.areaFrom = null
    filterForm.areaTo = null
    filter()
}
</script>
