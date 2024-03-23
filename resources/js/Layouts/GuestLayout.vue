<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 theme"
    >
        <div
            class="w-full sm:max-w-md mt-6 p-6 bg-neutral-50 dark:bg-[#161b31] shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<script setup>
import { useDark } from "@vueuse/core";
useDark();
</script>
