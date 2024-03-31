<template>
    <section class="padding grid gap-10 sm:grid-cols-1 md:grid-cols-[1fr_2fr]">
        <div
            class="justify-center items-center place-items-center space-y-10 max-md:hidden"
        >
            <PostCard
                :showAllExcerpt="true"
                v-for="post in props.recent_posts"
                :key="post.slug"
                :post="post"
            />
        </div>

        <div class="space-y-20">
            <PostCard :showPost="true" :post="props.post[0]" />
            <PostFooter />
        </div>
    </section>
</template>

<script setup>
import { reactive, computed } from "vue";
import { useHead } from "@vueuse/head";

import { UserLayout } from "@/Layouts";
import { PostCard, PostFooter } from "@/Components";

const props = defineProps({
    post: {
        required: true,
    },
    recent_posts: {
        required: true,
    },
});

const siteData = reactive({
    title: props.post[0].meta_title || props.post[0].title,
    description:
        props.post[0].meta_description || "This is the default description",
});

useHead({
    title: computed(() => siteData.title),
    meta: [
        {
            name: `description`,
            content: computed(() => siteData.description),
        },
    ],
});
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
