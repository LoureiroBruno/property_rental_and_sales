<template>
    <div
        class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl shadow-md p-6 space-y-4 transition-colors">
        <div v-if="$slots.header" class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                <slot name="header" />
            </h2>
            <div v-if="$slots.actions" class="flex items-center space-x-2">
                <slot name="actions" />
            </div>
        </div>

        <div class="text-gray-700 dark:text-gray-300 text-sm">
            <slot />
        </div>
    </div>
</template>

<style scoped>
div {
    transition: background-color 0.3s ease, border-color 0.3s ease;
}
</style>
