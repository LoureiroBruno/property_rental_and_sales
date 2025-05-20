<template>
    <h1 class="text-3xl mb-4 label">Edit User</h1>

    <form @submit.prevent="update" class="w-full mx-auto p-6 bg-white border border-gray-300 text-gray-800 
     dark:bg-gray-900 dark:border-gray-700 dark:text-gray-100 
     rounded-md shadow-md">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Linha 1: Name e Email -->
            <div>
                <label class="label">Name</label>
                <input id="name" v-model="form.name" type="text" class="input" placeholder="Your name" />
                <div v-if="form.errors.name" class="input-error">
                    {{ form.errors.name }}
                </div>
            </div>

            <div>
                <label class="label">Email</label>
                <input id="email" v-model="form.email" type="email" class="input" placeholder="you@example.com" />
                <div v-if="form.errors.email" class="input-error">
                    {{ form.errors.email }}
                </div>
            </div>

            <!-- Linha 2: Password e Confirm Password -->
            <div>
                <label class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="input"
                    placeholder="New password (optional)" />
                <div v-if="form.errors.password" class="input-error">
                    {{ form.errors.password }}
                </div>
            </div>

            <div>
                <label class="label">Confirm Password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input"
                    placeholder="Confirm new password" />
                <div v-if="form.errors.password_confirmation" class="input-error">
                    {{ form.errors.password_confirmation }}
                </div>
            </div>

            <!-- Botões -->
            <div class="sm:col-span-2 flex gap-2">
                <button type="submit" class="btn-primary">
                    <PencilSquareIcon class="w-5 h-5" />
                    Edit
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
import { Link, useForm } from '@inertiajs/vue3'
import { PencilSquareIcon, XMarkIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    user: Object,
})

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    password: '',
    password_confirmation: '',
})

const update = () => {
    form.put(route('user-account.update', props.user.id))
}
</script>

<style scoped>
.label {
    font-weight: bold;
}

.input {
    @apply w-full rounded border border-gray-300 dark:border-gray-700 p-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100;
}

.input-error {
    @apply text-sm text-red-600 dark:text-red-400 mt-1;
}

.btn-primary {
    @apply bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition flex items-center justify-center;
}

.btn-secondary {
    @apply bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded hover:bg-gray-400 dark:hover:bg-gray-600 transition flex items-center justify-center;
}
</style>
