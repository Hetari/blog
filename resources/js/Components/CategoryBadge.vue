<template>
    <div
        class="px-4 h-6 rounded-full text-xs font-semibold flex items-center cursor-pointer w-fit hover:text-white transition-all duration-300 ease-in-out"
    >
        <span v-if="showDot" class="w-2 h-2 rounded-full mr-1"></span>
        <Link :href="href">
            <slot></slot>
        </Link>
    </div>
</template>

<script setup>
const props = defineProps({
    color: {
        type: String,
        default: "purple",
    },
    showDot: {
        type: Boolean,
        default: false,
    },
    href: {
        type: String,
        default: "#",
    },
});
</script>
