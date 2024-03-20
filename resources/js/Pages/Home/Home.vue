<template>
    <Head title="Home" />
    <div class="padding-x pt-9">
        <Hero text="the blog" />
    </div>

    <div class="padding">
        <RecentBlogPosts />
    </div>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero, RecentBlogPosts } from "./Partials";
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
