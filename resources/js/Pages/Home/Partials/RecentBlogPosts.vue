<template>
    <section>
        <div v-if="posts.length > 0" class="grid md:grid-cols-2 gap-10">
            <FeaturedPostCard
                v-for="(post, index) in posts.slice(0, 3)"
                :key="post.id"
                :class="{
                    'md:col-span-2 xl:row-span-2': index === 0, // Apply this class only to the first post
                    'xl:col-span-1 max-sm:col-span-2 sm:col-span-2':
                        index !== 0, // Apply this class to all posts
                }"
                :mdAspect="index === 0"
                :post="post"
            />
        </div>

        <!-- TODO: Add animation here -->
        <p v-else class="text-center text-gray-500 dark:text-gray-400 text-lg">
            There are no posts available.
        </p>

        <div v-if="posts.length == 4" class="padding-y">
            <BigFeaturedPostCard :post="posts[3]" />
        </div>
    </section>
</template>

<script setup>
import { FeaturedPostCard, BigFeaturedPostCard } from "@/Components";

const props = defineProps({
    posts: {
        type: Object,
    },
});
</script>
