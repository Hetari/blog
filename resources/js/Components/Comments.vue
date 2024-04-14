<template>
    <section class="pt-6">
        <div class="text-left mb-6">
            <h2 class="text-lg lg:text-2xl font-bold">Discussion (20)</h2>
        </div>
        <form>
            <div
                class="py-2 px-4 rounded-lg border border-blue-400 dark:bg-gray-800 dark:border-gray-700 w-full relative"
            >
                <label for="comment" class="sr-only">Your comment</label>
                <textarea
                    id="comment"
                    rows="6"
                    class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 resize-none"
                    placeholder="Leave your comment here..."
                    required
                >
                </textarea>
                <button
                    type="submit"
                    class="absolute bottom-5 right-5 py-2.5 px-4 text-xs font-medium text-center bg-blue-600 text-white rounded-lg hover:bg-blue-800"
                >
                    Send
                </button>
            </div>
        </form>
    </section>

    <section class="space-y-10">
        <CommentCard class="bg-gray-100 dark:bg-gray-900 w-full rounded-lg p-5">
            <CommentCard class="ms-14" />
        </CommentCard>

        <CommentCard
            class="bg-gray-100 dark:bg-gray-900 w-full rounded-lg p-5"
        />
    </section>
</template>

<script setup>
import { CommentCard } from "@/Components";
</script>
