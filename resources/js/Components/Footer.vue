<template>
    <footer class="box-border relative w-full pt-5 border-t-[1px]">
        <div
            v-if="isDataFond"
            class="flex-col sm:flex sm:flex-row items-center justify-center sm:justify-between pt-5 text-sm text-gray-500"
        >
            <div class="sm:flex sm:flex-row sm:items-start sm:justify-start">
                <Component
                    :is="links[0].url ? 'Link' : 'span'"
                    class="flex flex-row items-center justify-center gap-2 dark:text-gray-200"
                    v-html="cleanLabel(links[0].label)"
                    :href="links[0].url"
                />
            </div>

            <!-- TODO: fix the links, so if there is 100 links, it doesn't break -->
            <!-- TODO: remove overflow-hidden when you fix it -->
            <div
                class="flex flex-row items-start max-sm:justify-center gap-[2px] text-center overflow-hidden"
            >
                <Link
                    v-for="(link, index) in links.slice(1, -1)"
                    :key="index"
                    class="size-10 relative rounded-lg bg-ghostwhite-200 overflow-hidden shrink-0 text-primary-600"
                    :class="{
                        'bg-violet-100 dark:bg-violet-200': link.active,
                    }"
                    :href="link.url"
                >
                    <div
                        class="absolute top-[0px] left-[0px] rounded-lg w-10 h-10 flex flex-row items-center justify-center p-3 box-border"
                    >
                        <div
                            class="relative leading-[20px] font-medium"
                            :class="{
                                'text-violet-700': link.active,
                                'dark:text-gray-200': !link.active,
                            }"
                        >
                            {{ link.label }}
                        </div>
                    </div>
                </Link>
            </div>

            <div class="sm:flex sm:flex-row sm:items-start sm:justify-start">
                <Component
                    :is="links[links.length - 1].url ? 'Link' : 'span'"
                    class="flex flex-row items-center justify-center gap-2 dark:text-gray-200"
                    v-html="cleanLabel(links[links.length - 1].label)"
                    :href="links[links.length - 1].url"
                />
            </div>
        </div>

        <div class="w-full text-center mt-10">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                &copy; {{ new Date().getFullYear() }} - Laravel Blog
            </p>
        </div>
    </footer>
</template>

<script setup>
import { computed } from "vue";

const props = defineProps({
    links: {
        type: Array,
        required: true,
    },
    isDataFond: {
        type: Boolean,
        default: false,
    },
    pageSize: {
        type: Number,
        default: 3,
    },
    currentPage: {
        type: Number,
        required: true,
    },
});

function cleanLabel(label) {
    let text = label.replace(/&laquo;|&raquo;| /g, "");
    if (text == "Previous") {
        text =
            `<svg 
            class="text-gray-400 dark:text-gray-200 stroke-current"
             width="14" height="15" viewBox="0 0 14 15" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.8334 7.49984H1.16675M1.16675 7.49984L7.00008 13.3332M1.16675 7.49984L7.00008 1.6665"  stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>` + text;
    } else if (text == "Next") {
        text += `<svg class="rotate-180 text-gray-400 dark:text-gray-200 stroke-current" width="14" height="15" viewBox="0 0 14 15" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.8334 7.49984H1.16675M1.16675 7.49984L7.00008 13.3332M1.16675 7.49984L7.00008 1.6665"  stroke-width="1.67" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>`;
    }
    return text;
}

function isNumeric(value) {
    return !isNaN(parseFloat(value)) && isFinite(value);
}

const pureLinks = props.links.filter((link) => isNumeric(link.label));
</script>
