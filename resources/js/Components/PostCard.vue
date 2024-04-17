<template>
    <article
        class="w-full flex-col justify-start items-start gap-8 inline-flex"
    >
        <img
            class="object-cover w-full h-full aspect-1"
            loading="lazy"
            :src="post.thumbnail"
        />

        <section
            class="flex-col size-full justify-start items-start gap-3 flex"
            :class="{
                'h-full': showAllExcerpt,
            }"
        >
            <div class="w-full flex justify-between">
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
                class="flex justify-between items-start w-full"
            >
                <h3
                    class="text-xl font-semibold cursor-pointer"
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
        </section>

        <section class="w-full flex items-center justify-between">
            <div class="inline-grid grid-cols-3 gap-3">
                <CategoryBadge
                    v-for="category in post.categories"
                    :key="category.id"
                    :href="`categories/${category.slug}`"
                    :color="category.color"
                >
                    <Link
                        v-html="category.color"
                        :href="`categories/${category.slug}`"
                    >
                    </Link>
                </CategoryBadge>
            </div>
            <div v-if="showPost" class="">
                <UpDownLike
                    :slug="post.slug"
                    :likes="totalLikes()"
                    :up_voted="isUpVoted()"
                    :down_voted="isDownVoted()"
                />
            </div>
        </section>

        <section v-if="showPost" class="w-full space-y-10">
            <Comments :slug="post.slug" :comments="post.comments" />
        </section>
    </article>
</template>

<script setup>
import { CategoryBadge, Comments } from "@/Components";
import { formatPublishedDate } from "@/functions";
import { UpDownLike } from "@/Components";
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const user_id = computed(() => usePage().props.auth?.user.id);

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

// calculate how many likes and dislike for the post
const totalLikes = () => {
    // const isLike = props.post.likes;
    const isLike = props.post.likes.filter((like) => like.is_like === 1);
    const dislike = props.post.likes.filter((like) => like.is_dislike === 1);
    return isLike.length - dislike.length;
};

const isUpVoted = () => {
    return (
        props.post.likes.filter(
            (like) => like.is_like === 1 && like.user_id === user_id.value
        ).length === 1
    );
};

const isDownVoted = () => {
    return (
        props.post.likes.filter(
            (like) => like.is_dislike === 1 && like.user_id === user_id.value
        ).length === 1
    );
};
</script>
