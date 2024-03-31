<template>
    <div class="space-y-8">
        <img class="w-full" src="https://via.placeholder.com/1216x556" />
        <article class="flex flex-1 flex-col justify-start items-start gap-4">
            <h1 class="text-2xl font-semibold">About Me</h1>

            <p class="leading-normal text-justify">
                As a passionate and experienced UI designer, I am dedicated to
                creating intuitive and engaging user experiences that meet the
                needs of my clients and their users. I have a strong
                understanding of design principles and a proficiency in design
                tools, and I am comfortable working with cross-functional teams
                to bring projects to fruition. I am confident in my ability to
                create designs that are both visually appealing and functional,
                and I am always looking for new challenges and opportunities to
                grow as a designer.
            </p>
        </article>

        <article
            v-for="(section, index) in aboutMe"
            :key="index"
            class="flex flex-1 flex-col justify-start items-start gap-4"
        >
            <h1 class="text-2xl font-semibold">{{ section.title }}</h1>
            <ul class="space-y-1 px-10">
                <li
                    v-for="(item, itemIndex) in section.items"
                    :key="itemIndex"
                    class="list-item list-disc"
                >
                    {{ item }}
                </li>
            </ul>
        </article>
    </div>

    <section class="padding">
        <Footer />
    </section>
</template>

<script setup>
import Footer from "@/Components/Footer.vue";
import { aboutMe } from "@/constants";
</script>
