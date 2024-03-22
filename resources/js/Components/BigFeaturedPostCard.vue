<template>
    <div class="xl:flex xl:justify-center xl:items-start w-full">
        <div class="max-lg:aspect-4 lg:aspect-3 xl:aspect-2 w-[100%]">
            <img
                :src="post.thumbnail"
                alt="post image"
                class="object-cover object-center w-full"
                style="width: 100%; height: 100%"
            />
        </div>

        <div class="space-y-3 xl:ml-10 h-full">
            <div class="max-lg:mt-3">
                <p class="text-[#6941C6] dark:text-[#a47cff] font-semibold">
                    <time>
                        {{ formatPublishedDate(post.published_at) }}
                    </time>
                </p>
            </div>

            <div class="flex justify-between items-center">
                <!-- Adjusted alignment -->
                <h3 class="text-2xl font-semibold cursor-pointer">
                    {{ post.title }}
                </h3>
                <span class="cursor-pointer p-5 -m-5">
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
            </div>

            <div>
                <p class="info-text line-clamp-3">
                    {{ post.excerpt }}
                </p>
            </div>

            <div class="pt-3 flex justify-start items-center gap-3">
                <!-- TODO: make a costume color for each category -->
                <CategoryBadge
                    v-for="category in post.categories"
                    :key="category.id"
                    class="bg-purple-100 text-purple-800 hover:bg-purple-500"
                >
                    {{ category.title }}
                </CategoryBadge>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CategoryBadge } from "@/Components";
import { formatPublishedDate } from "@/functions";

const props = defineProps({
    post: {
        type: Object,
        required: true,
    },
});
</script>
