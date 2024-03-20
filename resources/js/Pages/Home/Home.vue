<template>
    <Head title="Home" />
    <div class="padding-x padding-b pt-9">
        <Hero />
    </div>
</template>

<script setup>
import { UserLayout } from "@/Layouts";
import { Head } from "@inertiajs/vue3";
import { Hero } from "./Partials";
</script>

<script>
export default {
    layout: UserLayout,
};
</script>
