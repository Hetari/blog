<template>
    <main class="theme relative min-h-screen">
        <Nav />
        <slot />
    </main>
</template>

<script setup>
import { Nav } from "@/Components";
import { useDark } from "@vueuse/core";
useDark();
</script>
