<template>
    <Head title="Home" />
    <div class="padding-x pt-9">
        <Hero text="the blog" />
    </div>

    <div class="padding-x padding-t" v-if="posts.data.length >= 1">
        <RecentBlogPosts :posts="posts.data.slice(0, 4)" />
    </div>

    <!-- TODO: Add animation here -->
    <p
        v-else
        class="padding-t text-center text-red-500 dark:text-gray-400 text-lg"
    >
        There are no posts available.
    </p>

    <div class="padding" v-if="posts.data.length >= 5">
        <BlogPosts :posts="posts.data.slice(4)" />
    </div>

    <div class="padding">
        <Footer :links="posts.links" :isDataFond="posts.data.length > 0" />
    </div>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero, RecentBlogPosts, BlogPosts } from "./Partials";
import { Footer } from "@/Components";

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
