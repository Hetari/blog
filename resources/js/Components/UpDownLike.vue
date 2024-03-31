<template>
    <div class="space-x-2 flex items-center justify-end">
        <button
            id="up"
            @click="vote($event)"
            class="p-1 border rounded-full hover:bg-gray-100"
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
        <span class="text-2xl font-bold bg-red-100"> {{ likes }} </span>
        <button
            id="down"
            @click="vote($event)"
            class="p-1 border rounded-full hover:bg-gray-100"
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
import { ref } from "vue";
const props = defineProps({
    likes: {
        type: Number,
        default: 0,
    },
});

const likes = ref(props.likes);

const vote = (event) => {
    const buttonId = event.currentTarget.id;
    if (buttonId.toLowerCase() == "up") {
        likes.value++;
    } else if (buttonId.toLowerCase() == "down") {
        likes.value--;
    }
};
</script>
