<template>
    <div class="border-y-2 text-center">
        <h1
            ref="blogTitle"
            class="uppercase font-bold m-0 leading-none w-fit mx-auto"
        >
            {{ text }}
        </h1>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, onMounted } from "vue";

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
});

const blogTitle = ref(null);

const adjustFontSize = () => {
    if (blogTitle.value) {
        const container = blogTitle.value;
        const desiredWidth = container.parentNode.offsetWidth;

        let fontSize = parseInt(
            window
                .getComputedStyle(container, null)
                .getPropertyValue("font-size")
        );

        let minFontSize = 1;
        let maxFontSize = 1000;
        let optimalFontSize = -1;

        while (minFontSize <= maxFontSize) {
            const midFontSize = Math.floor((minFontSize + maxFontSize) / 2);
            container.style.fontSize = midFontSize + "px";

            if (container.scrollWidth <= desiredWidth - 10) {
                optimalFontSize = midFontSize;
                minFontSize = midFontSize + 1;
            } else {
                maxFontSize = midFontSize - 1;
            }
        }

        if (optimalFontSize !== -1) {
            container.style.fontSize = optimalFontSize + "px";
        }
    }
};

onBeforeMount(() => {
    window.addEventListener("resize", adjustFontSize);
});

onMounted(() => {
    adjustFontSize();
});
</script>
