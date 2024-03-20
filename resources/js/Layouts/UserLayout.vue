<template>
    <main class="theme relative h-dvh">
        <Nav />

        <slot />
    </main>
</template>

<script setup>
import { Nav } from "@/Components";
</script>
