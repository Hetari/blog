<template>
    <div class="border-y-2 text-center">
        <h1 class="uppercase font-bold m-0 w-fit mx-auto" id="blogTitle">
            {{ text }}
        </h1>
    </div>
</template>

<script setup>
const props = defineProps({
    text: {
        type: String,
        required: true,
    },
});
</script>

<style>
#blogTitle {
    /* font-size: clamp(3.125rem, 17.89vw + -0.788rem, 15.313rem) !important; */
    font-size: clamp(3.125rem, 17.5vw + -1.6rem, 15.313rem) !important;
    line-height: 1 !important;
}
</style>
