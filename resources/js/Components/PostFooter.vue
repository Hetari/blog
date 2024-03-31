<template>
    <footer>
        <div class="text-center space-y-5">
            <p class="text-[#6941C6] dark:text-[#a47cff] font-semibold">
                Newsletters
            </p>
            <h1 class="text-5xl font-semibold leading-10">
                Stories and interviews
            </h1>
            <p class="text-xl info-text">
                Subscribe to learn about new product features, the latest in
                technology, solutions, and updates.
            </p>
        </div>

        <div
            class="padding-t space-y-4 flex-col justify-around items-center gap-10"
        >
            <form class="flex gap-10">
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="input-filed w-3/5"
                    placeholder="Enter your email"
                    v-model="form.email"
                />
                <button
                    class="py-2 px-4 rounded-lg bg-[#6941C6] dark:bg-[#a47cff] transition-all duration-200 ease-in-out hover:bg-[#491cb3] dark:hover:bg-[#6941C6] text-white hover:scale-[0.98] focus:outline-none"
                    type="submit"
                >
                    Subscribe now
                </button>
            </form>

            <div>
                <p class="text-neutral-300 text-sm font-normal leading-tight">
                    We care about your data in our
                    <span
                        class="underline cursor-pointer transition-all duration-200 ease-in-out hover:text-[#6941C6] dark:hover:text-[#a47cff]"
                        >privacy policy</span
                    >
                </p>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
let form = ref({
    email: "",
});

const submit = () => {
    // router.post("/subscribe", form);
};
</script>
