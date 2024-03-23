<template>
    <Head title="Post" />
    <section class="padding grid gap-10 sm:grid-cols-1 md:grid-cols-[1fr_2fr]">
        <div
            class="justify-center items-center place-items-center space-y-10 max-md:hidden"
        >
            <PostCard
                :showAllExcerpt="true"
                v-for="post in recent_posts"
                :key="post.slug"
                :post="post"
            />
        </div>

        <div class="space-y-20">
            <PostCard :showPost="true" :post="post" />
            <PostFooter />
        </div>
    </section>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { UserLayout } from "@/Layouts";
import { PostCard, PostFooter } from "@/Components";
import { computed } from "vue";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    recent_posts: {
        type: Object,
        required: true,
    },
});

const shouldHideOnMobile = computed(() => {
    return window.innerWidth <= 640;
});
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
