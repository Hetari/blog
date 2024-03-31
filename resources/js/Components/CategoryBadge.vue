<template>
    <div
        class="px-4 h-6 rounded-full text-xs font-semibold flex items-center cursor-pointer w-fit transition-all duration-300 ease-in-out"
        :class="getColor[0]"
    >
        <!-- :class="`bg-gray-100 text-${textColor}-800 hover:bg-${bgColor}-500 hover:text-white`" -->
        <span
            v-if="showDot"
            class="w-2 h-2 rounded-full mr-1"
            :class="getColor[1]"
        ></span>

        <slot />
    </div>
</template>

<script setup>
import { onBeforeMount, computed, ref } from "vue";
import { colorVariants } from "@/constants";

const props = defineProps({
    color: {
        type: String,
    },
    showDot: {
        type: Boolean,
        default: false,
    },
});

let getColor = ref("");
onBeforeMount(() => {
    getColor = computed(() => {
        return colorVariants[props.color];
    });
});
</script>
