<template>
    <main class="theme relative min-h-screen">
        <Nav :canLogin="canLogin" />
        <slot />
    </main>
</template>

<script setup>
import { Nav } from "@/Components";
import { useDark } from "@vueuse/core";
useDark();

import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
const canLogin = computed(() => usePage().props.auth?.user);
</script>
