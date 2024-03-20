<template>
    <div
        class="h-full"
        :class="
            !mdAspect ? 'md:flex md:gap-5' : 'flex-col justify-end items-end'
        "
    >
        <div
            class="flex-1 max-sm:w-full"
            :class="mdAspect ? 'md:aspect-3' : ''"
        >
            <img
                :src="postImage"
                alt="post image"
                class="object-cover w-full"
                style="width: 100%; height: 100%"
            />
        </div>

        <div class="flex-1">
            <div :class="mdAspect ? 'my-3' : 'm-0 p-0'">
                <p class="text-[#6941C6] dark:text-[#a47cff] font-semibold">
                    Sunday, <time>1 Jan 2024</time>
                </p>
            </div>

            <h3 class="text-2xl font-semibold" :class="mdAspect ? 'my-3' : ''">
                UX review presentations
            </h3>
            <p class="info-text line-clamp-3" :class="mdAspect ? 'my-3' : ''">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                Consequuntur totam fuga, accusantium nemo iusto repellendus
                nesciunt rem dolore atque velit minus molestiae enim.
            </p>

            <div class="py-3 flex justify-start items-center gap-3">
                <CategoryBadge
                    class="bg-purple-100 text-purple-800 hover:bg-purple-500"
                >
                    Design
                </CategoryBadge>

                <CategoryBadge
                    class="bg-blue-100 text-blue-800 hover:bg-blue-500"
                >
                    Research
                </CategoryBadge>

                <CategoryBadge class="bg-red-100 text-red-800 hover:bg-red-500">
                    Presentation
                </CategoryBadge>
            </div>
        </div>
    </div>
</template>

<script setup>
import { CategoryBadge } from "@/Components";
import { postImage } from "@/images";

const props = defineProps({
    mdAspect: {
        type: Boolean,
        default: false,
    },
});
</script>
