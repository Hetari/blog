<template>
    <header
        class="padding-x py-8 font-[inter] flex justify-between"
        :class="{
            'flex-col items-center justify-around h-dvh py-px': showMenu,
        }"
    >
        <h1 class="text-xl font-semibold self-center">Blogy</h1>

        <div
            class="md:block md:w-auto lg:w-3/5 self-center"
            id="navbar-default"
            :class="{ hidden: !showMenu }"
        >
            <ul
                class="flex max-md:flex-col md:w-auto md:justify-around justify-center items-center max-lg:gap-8"
            >
                <li v-for="(link, index) in navLinks" :key="index">
                    <Link
                        :href="link.path"
                        :class="{
                            'font-semibold underline underline-offset-[5px]':
                                $page.url === link.path,
                        }"
                        >{{ link.name }}
                    </Link>
                </li>
                <li v-if="!canLogin ? true : false">
                    <Link
                        v-for="(link, index) in authLinks"
                        :key="index"
                        :href="link.path"
                        class="px-4 py-2 transition"
                        :class="
                            index === 0
                                ? 'rounded-l-xl text-white m-0 bg-black dark:bg-neutral-700 hover:bg-neutral-700 dark:hover:bg-neutral-600'
                                : 'dark:text-white rounded-e-xl bg-neutral-200/90 dark:bg-neutral-800  hover:bg-neutral-300 dark:hover:bg-neutral-900'
                        "
                    >
                        {{ link.name }}
                    </Link>
                </li>

                <li v-else>
                    <div class="relative">
                        <Dropdown
                            contentClasses="bg-neutral-50 dark:bg-neutral-700 py-1 rounded-xl"
                            align="right"
                            width="48"
                        >
                            <template #trigger>
                                <span class="inline-flex rounded-md">
                                    <button
                                        type="button"
                                        class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium focus:outline-none transition ease-in-out duration-150 rounded-xl text-white bg-black dark:bg-neutral-700 hover:bg-neutral-700 dark:hover:bg-neutral-600"
                                    >
                                        {{ $page.props.auth.user.name }}

                                        <svg
                                            class="ms-2 -me-0.5 h-4 w-4"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
                            </template>

                            <template #content>
                                <DropdownLink :href="route('profile.edit')">
                                    Profile
                                </DropdownLink>
                                <DropdownLink
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                >
                                    Log Out
                                </DropdownLink>
                            </template>
                        </Dropdown>
                    </div>
                </li>

                <div
                    class="w-24 h-10 px-4 py-2 rounded-full justify-start items-start gap-4 inline-flex cursor-pointer relative"
                    :class="isDarkMode ? 'bg-white' : 'bg-black'"
                    @click="toggleDarkMode()"
                >
                    <div
                        class="absolute size-6 rounded-full"
                        :class="{
                            'dark-slide': animateSlide && isDarkMode,
                            'translate-x-10 light-slide':
                                animateSlide && !isDarkMode,
                            'translate-x-0 bg-black': isDarkMode,
                            'translate-x-10 bg-white': !isDarkMode,
                        }"
                    ></div>

                    <div
                        :id="iconAnimation ? 'sun' : ''"
                        ref="parent"
                        class="w-6 h-6 relative"
                    >
                        <svg
                            v-if="!isDarkMode"
                            class="text-white fill-current"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 19.25C8 19.25 4.75 16 4.75 12C4.75 8 8 4.75 12 4.75C16 4.75 19.25 8 19.25 12C19.25 16 16 19.25 12 19.25ZM12 6.25C8.83 6.25 6.25 8.83 6.25 12C6.25 15.17 8.83 17.75 12 17.75C15.17 17.75 17.75 15.17 17.75 12C17.75 8.83 15.17 6.25 12 6.25Z"
                            />
                            <path
                                d="M12 22.96C11.45 22.96 11 22.55 11 22V21.92C11 21.37 11.45 20.92 12 20.92C12.55 20.92 13 21.37 13 21.92C13 22.47 12.55 22.96 12 22.96ZM19.14 20.14C18.88 20.14 18.63 20.04 18.43 19.85L18.3 19.72C17.91 19.33 17.91 18.7 18.3 18.31C18.69 17.92 19.32 17.92 19.71 18.31L19.84 18.44C20.23 18.83 20.23 19.46 19.84 19.85C19.65 20.04 19.4 20.14 19.14 20.14ZM4.86 20.14C4.6 20.14 4.35 20.04 4.15 19.85C3.76 19.46 3.76 18.83 4.15 18.44L4.28 18.31C4.67 17.92 5.3 17.92 5.69 18.31C6.08 18.7 6.08 19.33 5.69 19.72L5.56 19.85C5.37 20.04 5.11 20.14 4.86 20.14ZM22 13H21.92C21.37 13 20.92 12.55 20.92 12C20.92 11.45 21.37 11 21.92 11C22.47 11 22.96 11.45 22.96 12C22.96 12.55 22.55 13 22 13ZM2.08 13H2C1.45 13 1 12.55 1 12C1 11.45 1.45 11 2 11C2.55 11 3.04 11.45 3.04 12C3.04 12.55 2.63 13 2.08 13ZM19.01 5.99C18.75 5.99 18.5 5.89 18.3 5.7C17.91 5.31 17.91 4.68 18.3 4.29L18.43 4.16C18.82 3.77 19.45 3.77 19.84 4.16C20.23 4.55 20.23 5.18 19.84 5.57L19.71 5.7C19.52 5.89 19.27 5.99 19.01 5.99ZM4.99 5.99C4.73 5.99 4.48 5.89 4.28 5.7L4.15 5.56C3.76 5.17 3.76 4.54 4.15 4.15C4.54 3.76 5.17 3.76 5.56 4.15L5.69 4.28C6.08 4.67 6.08 5.3 5.69 5.69C5.5 5.89 5.24 5.99 4.99 5.99ZM12 3.04C11.45 3.04 11 2.63 11 2.08V2C11 1.45 11.45 1 12 1C12.55 1 13 1.45 13 2C13 2.55 12.55 3.04 12 3.04Z"
                            />
                        </svg>
                    </div>

                    <div
                        :id="iconAnimation ? 'moon' : ''"
                        ref="parent"
                        class="w-6 h-6"
                    >
                        <svg
                            v-if="isDarkMode"
                            class="text-[#090D1F] stroke-current"
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M10.9793 21.241L10.9793 21.2409L10.9722 21.2406C5.62035 21.0017 1.15035 16.686 0.778696 11.4447L0.778656 11.4442C0.454292 6.94125 3.05835 2.72964 7.26286 0.961403C7.81547 0.731669 8.19101 0.723728 8.43064 0.771655C8.67007 0.81954 8.81772 0.931941 8.90025 1.01741L8.90019 1.01746L8.90639 1.02367C8.99116 1.10843 9.09946 1.25509 9.14419 1.48454C9.18872 1.71296 9.17924 2.06939 8.95178 2.58991L8.95128 2.59107C8.46357 3.71491 8.2195 4.91384 8.22996 6.1434C8.25175 10.8463 12.1486 14.8185 16.8985 15.0097C17.5886 15.0414 18.2652 14.9881 18.9173 14.8724L18.9194 14.872C19.5024 14.7661 19.8651 14.8384 20.0844 14.9351C20.3035 15.0317 20.4219 15.1714 20.4845 15.2729C20.5493 15.3777 20.6232 15.5483 20.6141 15.7885C20.6049 16.0286 20.5109 16.3863 20.1582 16.8625L20.1563 16.865C18.1319 19.6343 14.9128 21.2501 11.4599 21.2501C11.2875 21.2501 11.1322 21.25 10.9793 21.241ZM1.27113 11.4044L1.27122 11.4057C1.62969 16.4243 5.89946 20.5182 10.987 20.7396C14.4443 20.9073 17.7243 19.3307 19.7432 16.5757L19.7433 16.5757L19.7468 16.5707C19.9192 16.3294 20.0111 16.1411 20.0581 16.0157L20.2837 15.4141L19.6452 15.3432C19.514 15.3286 19.3031 15.3182 18.9974 15.3787C18.3054 15.5016 17.5833 15.549 16.8699 15.5205L16.8698 15.5205C11.8528 15.321 7.74916 11.1062 7.71995 6.15865C7.72014 4.84669 7.97644 3.58694 8.49646 2.40409C8.62388 2.1228 8.65268 1.91939 8.66609 1.81213L8.73634 1.25011H8.16995C8.00012 1.25011 7.77385 1.2891 7.46577 1.41936C3.46087 3.1015 0.976314 7.11911 1.27113 11.4044Z"
                            />
                        </svg>
                    </div>
                </div>
            </ul>
        </div>

        <div
            class="flex justify-between md:hidden cursor-pointer p-5 -m-5"
            @click="toggleMenu"
        >
            <span class="sr-only">Open main menu</span>
            <svg
                v-if="!showMenu"
                class="fill-current"
                :class="isDarkMode ? 'text-white' : 'text-black'"
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
                class="fill-current"
                :class="isDarkMode ? 'text-white' : 'text-black'"
                width="32"
                height="32"
                viewBox="0 0 32 32"
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
import { onBeforeMount, ref, watch } from "vue";
import { navLinks, authLinks } from "@/constants";
import { useDark, useToggle } from "@vueuse/core";
import { useAutoAnimate } from "@formkit/auto-animate/vue";

import { Dropdown, DropdownLink } from "@/Components";

const props = defineProps({
    canLogin: {
        type: Object,
        default: () => {},
    },
});

// Define reactive refs
let showMenu = ref(false);
let animateSlide = ref(false);
let iconAnimation = ref(false);

// Initialize useDark hook
const isDarkMode = useDark();
const toggleDarkMode = useToggle(isDarkMode);

// Toggle menu function
const toggleMenu = () => {
    showMenu.value = !showMenu.value;

    // if (showMenu.value) {
    //     document.body.classList.add("no-scroll");
    // } else {
    //     document.body.classList.remove("no-scroll");
    // }
    document.body.classList[showMenu.value ? "add" : "remove"]("no-scroll");
};

onBeforeMount(() => {
    window.addEventListener("resize", () => {
        if (window.innerWidth > 768) {
            showMenu.value = false;
        }
    });
});

watch(isDarkMode, () => {
    // Check if the animation should be played initially
    const hasPlayedAnimation = localStorage.getItem("hasPlayedAnimation");
    if (hasPlayedAnimation) {
        animateSlide.value = true;
        localStorage.setItem("hasPlayedAnimation", "true");
    }

    if (animateSlide.value) {
        iconAnimation.value = true;
        setTimeout(() => {
            iconAnimation.value = false;
        }, 500);
    }
});

// Initialize useAutoAnimate
const [parent] = useAutoAnimate();
</script>
