<template>
    <div
        class="h-full"
        :class="
            !mdAspect ? 'md:flex md:gap-5' : 'flex-col justify-end items-end'
        "
    >
        <div
            class="flex-1 max-sm:w-full"
            :class="mdAspect ? 'md:aspect-3' : ''"
        >
            <img
                loading="lazy"
                :src="post.thumbnail"
                alt="post image"
                class="object-cover w-full"
                style="width: 100%; height: 100%"
            />
        </div>

        <div class="flex-1 max-sm:mt-3">
            <div
                class="flex justify-between"
                :class="mdAspect ? 'my-3' : 'm-0 p-0'"
            >
                <Link
                    :href="`/users/${post.user.username}`"
                    class="font-semibold text-[#6941C6] dark:text-[#a47cff]"
                >
                    <time>
                        {{ formatPublishedDate(post.published_at) }}
                    </time>
                    by
                    <span class="underline capitalize"
                        >{{ post.user.name }}
                    </span>
                </Link>
                <p class="text-sm text-gray-700 dark:text-gray-300">
                    {{ post.human_read_time }}
                </p>
            </div>

            <Link
                :href="`/posts/${post.slug}`"
                class="flex justify-between items-center"
            >
                <h3
                    class="text-2xl font-semibold cursor-pointer"
                    :class="mdAspect ? 'my-3' : ''"
                    v-html="post.title"
                ></h3>
                <span class="cursor-pointer">
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
                class="info-text line-clamp-3"
                :class="mdAspect ? 'my-3' : ''"
                v-html="post.excerpt"
            ></p>

            <div class="pt-3 inline-grid grid-cols-3 gap-3">
                <CategoryBadge
                    v-for="category in post.categories"
                    :key="category.id"
                    :color="category.color"
                >
                    <Link
                        v-html="category.title"
                        :href="`categories/${category.slug}`"
                    >
                    </Link>
                </CategoryBadge>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CategoryBadge } from "@/Components";
import { formatPublishedDate } from "@/functions";

const props = defineProps({
    mdAspect: {
        type: Boolean,
        default: false,
    },
    post: {
        type: Object,
        required: true,
    },
});
</script>
