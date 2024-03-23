<template>
    <main class="theme relative">
        <Nav />
        <slot />
    </main>
</template>

<script setup>
import { Nav } from "@/Components";
import { useDark } from "@vueuse/core";
useDark();
</script>
