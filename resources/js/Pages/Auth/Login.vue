<template>
    <div class="max-w-md mx-auto px-4">
        <h1 class="text-4xl font-extrabold text-slate-600 mb-6 text-center tracking-wide">
            Login
        </h1>
    </div>

    <div class="max-w-md mx-auto px-4">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
            <form @submit.prevent="login" novalidate>
                <div>
                    <label for="email" class="label">E-mail</label>
                    <input id="email" v-model="form.email" type="email" autocomplete="email" class="input"
                        :aria-invalid="form.errors.email ? 'true' : 'false'"
                        :aria-describedby="form.errors.email ? 'email-error' : null" />
                    <div v-if="form.errors.email" id="email-error" class="input-error">
                        {{ form.errors.email }}
                    </div>
                </div>

                <div class="mt-4">
                    <label for="password" class="label">Password</label>
                    <input id="password" v-model="form.password" type="password" autocomplete="current-password"
                        class="input" :aria-invalid="form.errors.password ? 'true' : 'false'"
                        :aria-describedby="form.errors.password ? 'password-error' : null" />
                    <div v-if="form.errors.password" id="password-error" class="input-error">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mt-6">
                    <button :disabled="form.processing" class="btn-indianred w-full" type="submit">
                        Login
                    </button>

                    <div class="mt-2 text-center">
                        <Link :href="route('user-account.create')" class="text-sm text-gray-500">
                        Need an account? Click here
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
    email: null,
    password: null,
})

const login = () => form.post(route('login.store'))
</script>
