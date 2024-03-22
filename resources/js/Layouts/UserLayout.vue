<template>
    <main class="theme relative">
        <Nav />

        <slot />

        <div class="padding">
            <Footer :links="posts.links" />
        </div>
    </main>
</template>

<script setup>
import { Nav, Footer } from "@/Components";

const props = defineProps({
    posts: {
        type: Object,
    },
});
</script>
