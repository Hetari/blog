<template>
    <main class="theme relative">
        <Nav />

        <slot />

        <div class="padding">
            <Footer :links="posts.links" :isDataFond="posts.data.length > 0" />
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
