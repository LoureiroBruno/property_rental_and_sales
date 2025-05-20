<template>
    <Box>
        <template #header>Upload New Images</template>
        <form @submit.prevent="upload">
            <section class="flex flex-col sm:flex-row sm:items-center gap-4 my-4">
                <input type="file" multiple @input="addFiles"
                    class="file-input file-input-bordered file-input-sm w-full max-w-xs dark:text-white" />
                <div class="flex gap-2">
                    <!-- Botão Upload -->
                    <button type="submit" :disabled="!canUpload"
                        class="btn-normal flex items-center gap-2 px-4 py-2 bg-red-500 text-white hover:bg-red-600 disabled:opacity-50 disabled:cursor-not-allowed">
                        <DocumentArrowUpIcon class="w-5 h-5" />
                        <span>Upload</span>
                    </button>

                    <!-- Botão Reset -->
                    <button type="reset" @click="reset" class="btn-secondary">
                        <ArrowUturnLeftIcon class="w-5 h-5" />
                        <span>Reset</span>
                    </button>

                    <!-- Botão Cancelar -->
                    <Link :href="route('listing.index')"
                        class="btn-normal flex items-center gap-2 px-4 py-2 bg-gray-200 text-black hover:bg-gray-300 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600">
                    <XMarkIcon class="w-5 h-5" />
                    <span>Cancelar</span>
                    </Link>
                </div>
            </section>

            <div v-if="imageErrors.length" class="text-sm text-red-600 mt-2">
                <ul class="list-disc pl-5">
                    <li v-for="(error, index) in imageErrors" :key="index">{{ error }}</li>
                </ul>
            </div>
        </form>
    </Box>

    <Box v-if="listing.images.length" class="mt-6">
        <template #header>Current Listing Images</template>
        <section class="mt-4 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            <div v-for="image in listing.images" :key="image.id"
                class="relative group border rounded-md overflow-hidden">
                <img :src="image.src" alt="Uploaded image" class="w-full h-48 object-cover" />
                <Link :href="route('realtor.listing.image.destroy', {
                    listing: props.listing.id,
                    image: image.id,
                })" method="delete" as="button"
                    class="absolute top-2 right-2 bg-white dark:bg-gray-800 text-red-600 hover:text-red-800 px-2 py-1 rounded-md text-xs opacity-0 group-hover:opacity-100 transition">
                Delete
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/vue3'
import {
    DocumentArrowUpIcon,
    ArrowUturnLeftIcon,
    XMarkIcon
} from '@heroicons/vue/24/solid'

const props = defineProps({ listing: Object })

const form = useForm({
    images: [],
})

const imageErrors = computed(() => Object.values(form.errors))
const canUpload = computed(() => form.images.length)

const upload = () => {
    form.post(
        route('realtor.listing.image.store', { listing: props.listing.id }),
        {
            onSuccess: () => form.reset('images'),
        }
    )
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image)
    }
}

const reset = () => form.reset('images')
</script>
