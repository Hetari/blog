<template>
    <section>
        <div class="w-full pb-10">
            <h3 class="text-2xl font-semibold">All blog posts</h3>
        </div>
        <div
            class="w-full grid max-sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-center items-center gap-10 place-items-center"
        >
            <PostCard v-for="post in posts" :key="post.id" :post="post" />
        </div>
    </section>
</template>

<script setup>
import { PostCard } from "@/Components";

const props = defineProps({
    posts: {
        type: Object,
        required: true,
    },
});
</script>
