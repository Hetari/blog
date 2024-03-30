<template>
    <Head title="About" />
    <section class="padding-x pt-9">
        <Hero text="the blog" />
    </section>

    <section class="padding">
        <AboutMe />
    </section>
</template>

<script setup>
import { Hero } from "../Home/Partials";
import { Head } from "@inertiajs/vue3";
import { UserLayout } from "@/Layouts";
import { AboutMe } from "./Partials";
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
