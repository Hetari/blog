<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 rounded-xl dark:bg-neutral-700 hover:bg-neutral-200 dark:hover:bg-neutral-600 transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
