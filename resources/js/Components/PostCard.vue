<template>
    <div class="w-full flex-col justify-start items-start gap-8 inline-flex">
        <img
            class="w-full h-full relative"
            loading="lazy"
            :src="post.thumbnail"
        />

        <div
            class="flex-col justify-start items-start gap-3 flex"
            :class="{
                'h-full': showAllExcerpt,
            }"
        >
            <p class="text-[#6941C6] dark:text-[#a47cff] font-semibold">
                <time :datetime="post.published_at">
                    {{ formatPublishedDate(post.published_at) }}
                </time>
            </p>

            <Link
                :href="`${post.slug}`"
                class="flex justify-between items-start w-full"
            >
                <h3
                    class="text-2xl font-semibold cursor-pointer"
                    v-html="post.title"
                ></h3>
                <span class="pt-3">
                    <svg
                        class="theme stroke-current"
                        width="12"
                        height="12"
                        viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M1 11L11 1M11 1H1M11 1V11"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </Link>
            <p
                class="info-text space-y-5"
                :class="{
                    'line-clamp-5': showAllExcerpt,
                    'line-clamp-none': showPost,
                    'line-clamp-3': !showPost,
                }"
                v-html="!showPost ? post.excerpt : post.body"
            ></p>
        </div>

        <div class="flex justify-start items-center gap-3">
            <!-- TODO: make a costume color for each category -->
            <CategoryBadge
                v-for="category in post.categories"
                :key="category.id"
                :href="`categories/${category.slug}`"
                class="bg-purple-100 text-purple-800 hover:bg-purple-500"
            >
                {{ category.title }}
            </CategoryBadge>
        </div>
    </div>
</template>

<script setup>
import CategoryBadge from "./CategoryBadge.vue";
import { formatPublishedDate } from "@/functions";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
    showAllExcerpt: {
        type: Boolean,
        default: false,
    },
    showPost: {
        type: Boolean,
        default: false,
    },
});
</script>
