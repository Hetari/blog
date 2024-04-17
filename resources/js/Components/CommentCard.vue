<template>
    <article class="space-y-4">
        <div class="flex items-start">
            <img
                class="size-10 rounded-full me-4"
                y
                src="https://i.pravatar.cc/40?u={{ comment.user_id }}"
                alt="Rounded avatar"
            />
            <div class="flex-col items-center mb-6 space-y-2">
                <div class="text-sm">
                    <p class="text-gray-900 dark:text-white">
                        {{ comment.user.name }}
                    </p>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ formatPublishedDate(comment.created_at) }}
                    </p>
                </div>
                <div>
                    <p class="mb-5">
                        {{ comment.comment }}
                    </p>
                </div>
                <div
                    class="flex text-sm lg:gap-10"
                    :class="showLabels() ? 'gap-10' : 'gap-5'"
                >
                    <Link
                        href="#"
                        class="flex items-end gap-2 hover:text-blue-500 group"
                    >
                        <svg
                            class="text-[#77808B] group-hover:text-blue-500 fill-current"
                            width="20"
                            height="20"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M17.333 0.833008H2.66634C1.65801 0.833008 0.833008 1.65801 0.833008 2.66634V19.1663L4.49967 15.4997H17.333C18.3413 15.4997 19.1663 14.6747 19.1663 13.6663V2.66634C19.1663 1.65801 18.3413 0.833008 17.333 0.833008ZM17.333 13.6663H4.49967L2.66634 15.4997V2.66634H17.333V13.6663Z"
                            />
                        </svg>
                        <p v-if="!showLabels()">Replay</p>
                    </Link>

                    <Link
                        @click="editComment(comment.id)"
                        v-if="canLogin.id == comment.user_id"
                        href="#"
                        class="flex items-center gap-2 hover:text-green-500 group"
                    >
                        <svg
                            class="text-[#77808B] group-hover:text-green-500 fill-current"
                            width="18"
                            height="18"
                            viewBox="0 0 18 18"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M0.75 13.8128V17.2503H4.1875L14.3258 7.11201L10.8883 3.67451L0.75 13.8128ZM16.9842 4.45367C17.3417 4.09617 17.3417 3.51867 16.9842 3.16117L14.8392 1.01617C14.4817 0.658672 13.9042 0.658672 13.5467 1.01617L11.8692 2.69367L15.3067 6.13117L16.9842 4.45367Z"
                            />
                        </svg>
                        <p v-if="!showLabels()">Edit</p>
                    </Link>

                    <Link
                        v-if="canLogin.id == comment.user_id"
                        href="#"
                        class="flex items-center gap-2 hover:text-red-500 group"
                        @click.prevent="deleteComment(comment.id)"
                    >
                        <svg
                            class="text-[#77808B] group-hover:text-red-500 fill-current"
                            width="14"
                            height="18"
                            viewBox="0 0 14 18"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M1.49967 15.4167C1.49967 16.425 2.32467 17.25 3.33301 17.25H10.6663C11.6747 17.25 12.4997 16.425 12.4997 15.4167V4.41667H1.49967V15.4167ZM3.33301 6.25H10.6663V15.4167H3.33301V6.25ZM10.208 1.66667L9.29134 0.75H4.70801L3.79134 1.66667H0.583008V3.5H13.4163V1.66667H10.208Z"
                            />
                        </svg>
                        <p v-if="!showLabels()">Delete</p>
                    </Link>
                </div>
            </div>
        </div>
        <slot />
    </article>
</template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { formatPublishedDate } from "@/functions";
import { router } from "@inertiajs/vue3";

const canLogin = computed(() => usePage().props.auth?.user);

const props = defineProps({
    comment: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["editComment"]);

const showLabels = () => {
    return window.innerWidth < 640;
};

const deleteComment = (id) => {
    router.delete(`/comments/${id}`, {
        preserveState: true,
        replace: true,
        preserveScroll: true,
    });
};

const editComment = () => {
    emit("editComment", props.comment);
    router.cancel();
};
</script>
