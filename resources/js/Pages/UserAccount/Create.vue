<template>
    <div class="max-w-md mx-auto px-4 py-8">
        <h1 class="text-4xl font-extrabold text-slate-600 mb-8 text-center tracking-wide">
            Create Account
        </h1>

        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
            <form @submit.prevent="register" novalidate>
                <div>
                    <label for="name" class="label">Your Name</label>
                    <input id="name" v-model="form.name" type="text" class="input" autocomplete="name" required
                        :class="{ 'border-red-500': form.errors.name }"
                        :aria-invalid="form.errors.name ? 'true' : 'false'"
                        :aria-describedby="form.errors.name ? 'name-error' : null" />
                    <div v-if="form.errors.name" id="name-error" class="input-error">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div class="mt-4">
                    <label for="email" class="label">E-mail</label>
                    <input id="email" v-model="form.email" type="email" class="input" autocomplete="email" required
                        :class="{ 'border-red-500': form.errors.email }"
                        :aria-invalid="form.errors.email ? 'true' : 'false'"
                        :aria-describedby="form.errors.email ? 'email-error' : null" />
                    <div v-if="form.errors.email" id="email-error" class="input-error">
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="label">Password</label>
                    <input id="password" v-model="form.password" type="password" class="input"
                        autocomplete="new-password" required :class="{ 'border-red-500': form.errors.password }"
                        :aria-invalid="form.errors.password ? 'true' : 'false'"
                        :aria-describedby="form.errors.password ? 'password-error' : null" />
                    <div v-if="form.errors.password" id="password-error" class="input-error">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    <input id="password_confirmation" v-model="form.password_confirmation" type="password" class="input"
                        autocomplete="new-password" required />
                </div>

                <div class="mt-6 space-y-2">
                    <button class="btn-indianred w-full" type="submit" :disabled="form.processing">
                        {{ form.processing ? 'Creating...' : 'Create Account' }}
                    </button>

                    <div class="text-center">
                        <Link :href="route('login')" class="text-sm text-gray-500 hover:underline">
                        Already have an account? Click here
                        </Link>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = () => form.post(route('user-account.store'))
</script>