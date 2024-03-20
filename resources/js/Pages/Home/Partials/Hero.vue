<template>
    <div class="border-y-2 text-center">
        <h1 ref="blogTitle" class="uppercase font-bold m-0 leading-none">
            The blog
        </h1>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, onMounted } from "vue";
const blogTitle = ref(null);

const adjustFontSize = () => {
    if (blogTitle.value) {
        // Get the width of the parent container
        const maxWidth = blogTitle.value.parentNode.offsetWidth;

        // Adjust the divisor as needed for appropriate scaling
        const fontSize = maxWidth / 4.85;

        // Set the font size in pixels
        blogTitle.value.style.fontSize = fontSize + "px";
    }
};

onBeforeMount(() => {
    window.addEventListener("resize", adjustFontSize);
});

onMounted(() => {
    adjustFontSize();
});
</script>
