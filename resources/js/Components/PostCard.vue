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
            <p class="font-semibold text-[#6941C6] dark:text-[#a47cff]">
                <Link :href="`/users/${post.user.username}`" class="capitalize">
                    <time>
                        {{ formatPublishedDate(post.published_at) }}
                    </time>
                    by <span class="underline">{{ post.user.name }} </span>
                </Link>
            </p>

            <Link
                :href="`/posts/${post.slug}`"
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

        <div class="w-full flex items-center justify-between">
            <div class="inline-grid grid-cols-3 gap-3">
                <CategoryBadge
                    v-for="category in post.categories"
                    :key="category.id"
                    :href="`categories/${category.slug}`"
                    :color="category.color"
                >
                    <Link
                        v-html="category.bg_color"
                        :href="`categories/${category.slug}`"
                    >
                    </Link>
                </CategoryBadge>
            </div>
            <div v-if="showPost" class="">
                <UpDownLike :likes="Likes" />
            </div>
        </div>
    </div>
</template>

<script setup>
import CategoryBadge from "./CategoryBadge.vue";
import { formatPublishedDate } from "@/functions";
import { UpDownLike } from "@/Components";

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
    Likes: {
        type: Number,
        default: 0,
    },
});
</script>
