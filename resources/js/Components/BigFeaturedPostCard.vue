<template>
    <div class="xl:flex xl:justify-center xl:items-start w-full">
        <div class="max-lg:aspect-4 lg:aspect-3 xl:aspect-2 w-[100%]">
            <img
                :src="postImage"
                alt="post image"
                class="object-cover object-center w-full"
                style="width: 100%; height: 100%"
            />
        </div>

        <div class="space-y-3 xl:ml-10 h-full">
            <div class="max-sm:mt-3">
                <p class="text-[#6941C6] dark:text-[#a47cff] font-semibold">
                    Sunday, <time>1 Jan 2024</time>
                </p>
            </div>

            <div class="flex justify-between items-center">
                <!-- Adjusted alignment -->
                <h3 class="text-2xl font-semibold cursor-pointer">
                    UX review presentations
                </h3>
                <span class="cursor-pointer p-5 -m-5">
                    <svg
                        class="theme stroke-current"
                        width="12"
                        height="12"
                        viewBox="0 0 12 12"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M1 11L11 1M11 1H1M11 1V11"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        />
                    </svg>
                </span>
            </div>

            <div>
                <p class="info-text line-clamp-3">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Consequuntur totam fuga, accusantium nemo iusto repellendus
                    nesciunt rem dolore atque velit minus molestiae enim.
                </p>
            </div>

            <div class="pt-3 flex justify-start items-end gap-3">
                <!-- Adjusted alignment -->
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
</script>
