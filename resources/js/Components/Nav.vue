<template>
    <header
        class="padding-x py-6 font-[inter] flex justify-between"
        :class="{
            'flex-col items-center justify-around h-dvh py-px': showMenu,
        }"
    >
        <h1 class="text-xl font-semibold" :class="{ 'pt-20': showMenu }">
            Your Name
        </h1>

        <div
            class="md:block md:w-auto lg:w-3/5 self-center"
            id="navbar-default"
            :class="{ hidden: !showMenu }"
        >
            <ul
                class="flex max-md:flex-col md:w-auto md:justify-around justify-center items-center max-lg:gap-10"
            >
                <li v-for="(link, index) in navLinks" :key="index">
                    <a :href="link.path">{{ link.name }}</a>
                </li>
            </ul>
        </div>

        <div
            class="flex justify-between md:hidden cursor-pointer p-5 -m-5"
            @click="toggleMenu"
        >
            <span class="sr-only">Open main menu</span>
            <svg
                v-if="!showMenu"
                class="text-black fill-current"
                width="32"
                height="32"
                viewBox="0 0 32 32"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M26.7333 14.667H5.26667C4.56711 14.667 4 15.2341 4 15.9337V16.067C4 16.7666 4.56711 17.3337 5.26667 17.3337H26.7333C27.4329 17.3337 28 16.7666 28 16.067V15.9337C28 15.2341 27.4329 14.667 26.7333 14.667Z"
                />
                <path
                    d="M26.7333 21.333H5.26667C4.56711 21.333 4 21.9001 4 22.5997V22.733C4 23.4326 4.56711 23.9997 5.26667 23.9997H26.7333C27.4329 23.9997 28 23.4326 28 22.733V22.5997C28 21.9001 27.4329 21.333 26.7333 21.333Z"
                />
                <path
                    d="M26.7333 8H5.26667C4.56711 8 4 8.56711 4 9.26667V9.4C4 10.0996 4.56711 10.6667 5.26667 10.6667H26.7333C27.4329 10.6667 28 10.0996 28 9.4V9.26667C28 8.56711 27.4329 8 26.7333 8Z"
                />
            </svg>

            <svg
                v-if="showMenu"
                class="text-black fill-current"
                :class="{
                    'absolute bottom-[53px] -translate-x-2/4': showMenu,
                }"
                width="32"
                height="32"
                viewBox="0 0 32 32"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M24.5324 23.0749L9.35319 7.89567C8.85852 7.401 8.05652 7.401 7.56185 7.89567L7.46757 7.98995C6.97291 8.48461 6.97291 9.28662 7.46757 9.78129L22.6468 24.9605C23.1415 25.4552 23.9435 25.4552 24.4381 24.9605L24.5324 24.8662C25.0271 24.3716 25.0271 23.5696 24.5324 23.0749Z"
                />
                <path
                    d="M22.6469 7.92511L7.46769 23.1043C6.97303 23.599 6.97303 24.401 7.46769 24.8957L7.56197 24.9899C8.05663 25.4846 8.85864 25.4846 9.35331 24.9899L24.5325 9.81072C25.0272 9.31606 25.0272 8.51405 24.5325 8.01939L24.4383 7.92511C23.9436 7.43044 23.1416 7.43044 22.6469 7.92511Z"
                />
            </svg>
        </div>
    </header>
</template>

<script setup>
import { ref } from "vue";
import { navLinks } from "@/constants";

let showMenu = ref(false);

const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};
</script>
