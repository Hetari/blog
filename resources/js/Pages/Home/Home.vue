<template>
    <Head title="Home" />
    <section class="padding-x pt-9">
        <Hero text="the blog" />
    </section>

    <section class="padding-x padding-t flex justify-between items-center">
        <h3 class="text-2xl font-semibold">Recent blog posts</h3>
        <input
            type="text"
            class="input-filed bg-red-100"
            placeholder="Search..."
            v-model="search"
        />
    </section>

    <section>
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
    </section>

    <section class="padding" v-if="posts.data.length >= 5">
        <BlogPosts :posts="posts.data.slice(4)" />
    </section>

    <section class="padding">
        <Footer :links="posts.links" :isDataFond="posts.data.length > 0" />
    </section>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero, RecentBlogPosts, BlogPosts } from "./Partials";
import { Footer } from "@/Components";
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    posts: {
        type: Object,
    },
});

// get the search flitter from the query string
let params = new URLSearchParams(window.location.search);
let search = ref(params.get("search"));

watch(search, (value) => {
    router.get(
        params,
        { search: value },
        { preserveState: true },
        { replace: true }
    );
});
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
