<template>
    <Head title="Home" />
    <div class="padding-x pt-9">
        <Hero text="the blog" />
    </div>

    <div class="padding">
        <RecentBlogPosts :posts="posts.data.slice(0, 4)" />
    </div>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero, RecentBlogPosts } from "./Partials";

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
