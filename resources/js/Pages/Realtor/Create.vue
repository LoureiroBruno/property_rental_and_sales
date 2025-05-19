<template>
    <h1 class="text-3xl mb-4 label">Create New List</h1>

    <form @submit.prevent="create" class="w-full mx-auto p-6 bg-white dark:bg-gray-900 rounded-md shadow-md">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Beds</label>
                <input id="beds" v-model.number="form.beds" type="number" class="input" placeholder="Ex: 3" />
                <div v-if="form.errors.beds" class="input-error">
                    {{ form.errors.beds }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Baths</label>
                <input id="baths" v-model.number="form.baths" type="number" class="input" placeholder="Ex: 2" />
                <div v-if="form.errors.baths" class="input-error">
                    {{ form.errors.baths }}
                </div>
            </div>
            <div class="col-span-2">
                <label class="label">Area</label>
                <input id="area" v-model.number="form.area" type="number" class="input" placeholder="Ex: 120" />
                <div v-if="form.errors.area" class="input-error">
                    {{ form.errors.area }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">City</label>
                <input id="city" v-model="form.city" type="text" class="input" placeholder="Ex: São Paulo" />
                <div v-if="form.errors.city" class="input-error">
                    {{ form.errors.city }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Post Code</label>
                <input id="code" v-model="form.code" type="text" class="input" placeholder="Ex: 12345-678" />
                <div v-if="form.errors.code" class="input-error">
                    {{ form.errors.code }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Street</label>
                <input id="street" v-model="form.street" type="text" class="input" placeholder="Ex: Av. Brasil" />
                <div v-if="form.errors.street" class="input-error">
                    {{ form.errors.street }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Street Nr</label>
                <input id="street_nr" v-model.number="form.street_nr" type="number" class="input"
                    placeholder="Ex: 123" />
                <div v-if="form.errors.street_nr" class="input-error">
                    {{ form.errors.street_nr }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input id="price" v-model.number="form.price" type="number" class="input" placeholder="Ex: 250000" />
                <div v-if="form.errors.price" class="input-error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div class="col-span-6 flex gap-2">
                <button type="submit" class="btn-primary">
                    <PlusIcon class="w-5 h-5" />
                    Create
                </button>
                <Link :href="route('listing.index')" class="btn-secondary">
                <XMarkIcon class="w-5 h-5" />
                Cancel
                </Link>
            </div>
        </div>
    </form>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { PlusIcon, XMarkIcon } from '@heroicons/vue/24/solid'

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: '',
    street: '',
    code: '',
    street_nr: null,
    price: 0,
})

const create = () => form.post(route('realtor.listing.store'))
</script>

<style scoped>
label {
    margin-right: 2em;
}

div {
    padding: 2px;
}

.input-error {
    color: #dc2626;
    /* Tailwind red-600 */
    font-size: 0.875rem;
    margin-top: 0.25rem;
}

.input {
    border: 1px solid #d1d5db;
    /* Tailwind gray-300 */
    padding: 0.5rem;
    border-radius: 0.375rem;
    width: 100%;
    box-sizing: border-box;
}

.btn-primary {
    @apply bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition flex items-center justify-center;
}

.btn-secondary {
    @apply bg-gray-300 text-gray-700 px-4 py-2 rounded flex items-center gap-2 hover:bg-gray-400;
}
</style>