<template>
    <div class="space-x-2 gap-3 flex items-center justify-center">
        <button
            id="up"
            @click="vote($event)"
            class="p-1 rounded-full hover:bg-blue-400 hover:dark:bg-blue-600 transition-all duration-300"
            :class="{ 'bg-blue-400 dark:bg-blue-600': upVoted }"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 15l7-7 7 7"
                />
            </svg>
        </button>
        <span class="text-2xl font-bold w-full text-center">
            {{ formatLikes(likes) }}
        </span>
        <button
            id="down"
            @click="vote($event)"
            class="p-1 rounded-full hover:bg-red-400 hover:dark:bg-red-500 transition-all duration-300"
            :class="{ 'bg-red-400 dark:bg-red-600': downVoted }"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                class="size-6 rotate-180"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M5 15l7-7 7 7"
                />
            </svg>
        </button>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { router } from "@inertiajs/vue3";
import { watch } from "vue";
import { usePage } from "@inertiajs/vue3";
import { formatLikes } from "@/functions";

const props = defineProps({
    likes: {
        type: Number,
        default: 0,
    },
    slug: {
        type: String,
        required: true,
    },
    up_voted: {
        type: Boolean,
        default: false,
    },
    down_voted: {
        type: Boolean,
        default: false,
    },
});
const canLogin = computed(() => usePage().props.auth?.user);

const likes = ref(props.likes + 0);

const upVoted = ref(props.up_voted);
const downVoted = ref(props.down_voted);

const vote = (event) => {
    if (!canLogin.value) {
        return (window.location.href = "/login");
    }
    // Get the target id.
    const direction = event.currentTarget.id;
    // Handle up vote.
    if (direction === "up") {
        // If down vote clicked and liked, remove the down vote and up vote it.
        if (downVoted.value) {
            likes.value++;
            downVoted.value = false;
            // If up vote clicked and not liked yet, like it.
        } else if (!upVoted.value) {
            likes.value++;
            upVoted.value = true;

            // If down vote clicked and up vote is clicked again, remove the down vote.
            if (downVoted.value) downVoted.value = false;
            // If up vote clicked and liked, dislike it.
        } else {
            // Cancel up vote if clicked again
            likes.value--;
            upVoted.value = false;
        }
        // Handle down vote.
    } else if (direction === "down") {
        // If up vote clicked and liked, remove the up vote and down vote it.
        if (upVoted.value) {
            likes.value--;
            upVoted.value = false;

            // If down vote clicked and not liked yet, dislike it.
        } else if (!downVoted.value) {
            likes.value--;
            downVoted.value = true;

            // If up vote clicked and down vote is clicked again, remove the up vote.
            if (upVoted.value) upVoted.value = false;
            // If down vote clicked and disliked, like it.
        } else {
            likes.value++;
            downVoted.value = false; // Cancel down vote if clicked again
        }
    }
};

watch(likes, () => {
    router.post(
        `/posts/${props.slug}/like`,
        { isLike: upVoted.value, isDislike: downVoted.value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        }
    );
});
</script>
