<template>
    <section class="pt-6">
        <div class="text-left mb-6">
            <h2 class="text-lg lg:text-2xl font-bold">
                Discussion ({{ comments.length }})
            </h2>
        </div>
        <form>
            <div
                id="comment-container"
                class="py-2 px-4 rounded-lg border border-blue-400 dark:bg-gray-800 dark:border-gray-700 w-full relative"
                :class="{ groupe: !canLogin }"
                @click="focusComment"
            >
                <label for="comment" class="sr-only">Your comment</label>
                <textarea
                    ref="commentInput"
                    rows="6"
                    class="px-0 mb-14 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 resize-none"
                    :placeholder="
                        canLogin
                            ? 'Leave your comment here...'
                            : 'Log in to leave a comment...'
                    "
                    :class="{
                        'cursor-not-allowed pointer-events-none': !canLogin,
                    }"
                    :required="canLogin"
                    :readonly="!canLogin"
                    v-model="comment"
                >
                </textarea>
                <button
                    id="comment-btn"
                    @click.prevent="sendComment"
                    type="submit"
                    class="absolute bottom-5 right-5 py-2.5 px-4 text-xs font-medium text-center rounded-lg"
                    :class="
                        canLogin
                            ? 'bg-blue-600 text-white hover:bg-blue-800'
                            : 'bg-gray-500 text-gray-100 hover:bg-gray-600'
                    "
                    v-html="canLogin ? 'Send' : 'Login to comment'"
                ></button>
            </div>
        </form>
    </section>

    <section class="space-y-10 space-y-reverse flex flex-col-reverse">
        <CommentCard
            class="bg-gray-100 dark:bg-gray-900 w-full rounded-lg p-5"
            v-for="comment in comments"
            :key="comment.id"
            :comment="comment"
        >
            <!-- <CommentCard class="ms-14" /> -->
        </CommentCard>
    </section>
</template>

<script setup>
import { CommentCard } from "@/Components";
import { router } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import tippy from "tippy.js";
import "tippy.js/dist/tippy.css";

const canLogin = computed(() => usePage().props.auth?.user);
const commentInput = ref(null);

const props = defineProps({
    slug: {
        type: String,
        required: true,
    },
    comments: {
        type: Array,
        default: [],
    },
});

const comment = ref("");

const sendComment = () => {
    if (!canLogin.value) {
        // go to login page
        return router.get("/login");
    }
    const createComment = `/posts/${props.slug}/comment`;
    console.log(createComment);

    router.post(
        createComment,
        {
            comment: comment.value,
        },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true,
        }
    );
};

const focusComment = () => {
    commentInput.value.focus();
};

onMounted(() => {
    tippy("#comment-container", {
        content: `${
            canLogin.value
                ? "Leave your comment here..."
                : "Log in to leave a comment..."
        }`,
    });
});
</script>
