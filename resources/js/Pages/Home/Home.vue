<template>
    <Head title="Home" />
    <div class="padding-x pt-9">
        <Hero text="the blog" />
    </div>

    <div class="padding-x padding-t" v-if="posts.data.length >= 1">
        <RecentBlogPosts :posts="posts.data.slice(0, 4)" />
    </div>

    <div class="padding" v-if="posts.data.length >= 5">
        <BlogPosts :posts="posts.data.slice(4)" />
    </div>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero, RecentBlogPosts, BlogPosts } from "./Partials";

const props = defineProps({
    posts: {
        type: Object,
    },
});
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
