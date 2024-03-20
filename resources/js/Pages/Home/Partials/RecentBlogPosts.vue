<template>
    <section>
        <div class="w-full padding-b">
            <h3 class="text-2xl font-semibold">Recent blog posts</h3>
        </div>

        <div class="grid md:grid-cols-2 gap-10">
            <FeaturedPostCard
                class="md:col-span-2 xl:col-span-1 xl:row-span-2"
                :mdAspect="true"
            />
            <FeaturedPostCard
                class="md:col-span-2 xl:col-span-1 xl:row-span-1"
            />
            <FeaturedPostCard
                class="md:col-span-2 xl:col-span-1 xl:row-span-1"
            />
        </div>
    </section>
</template>

<script setup>
import { FeaturedPostCard } from "@/Components";
</script>
