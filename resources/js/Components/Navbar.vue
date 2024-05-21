<script setup>
import axios from "axios";
import PongBirdLogo from "./PongbirdLogo.vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import UserLogo from "./UserLogo.vue";

const page = usePage();

const user = computed(() => page.props.auth.user ?? null);

const isMenuOpen = ref(false);

const toggleMenu = () => {
    console.log("Toggle menu");
    isMenuOpen.value = !isMenuOpen.value;
};
</script>

<template>
    <div class="flex justify-between bg-pb-yellow p-2 lg:p-4">
        <div class="relative container flex justify-between items-center">
            <Link
                href="/"
                class="flex items-center font-bold gap-2 text-pb-soft-grey"
            >
                <PongBirdLogo />
                <div class="text-2xl">Pongbird</div>
            </Link>
            <button
                @click="toggleMenu"
                value="hamburger"
                class="lg:hidden flex flex-col justify-around h-8 w-8 p-1 rounded hover:bg-w"
            >
                <!-- Hamburger Icon (3 lines) -->
                <span class="h-0.5 rounded bg-gray-600 w-full"></span>
                <span class="h-0.5 rounded bg-gray-600 w-full"></span>
                <span class="h-0.5 rounded bg-gray-600 w-full"></span>
            </button>
            <div
                v-show="isMenuOpen"
                id="nav-menu-links"
                class="lg:hidden z-10 bg-pb-yellow rounded-b-md shadow-md py-4 w-full left-0 absolute top-10 flex-col flex items-center font-bold gap-2 text-pb-soft-grey"
            >
                <Link class="hover:text-pb-dark-grey" href="/"
                    >Leaderboard</Link
                >
                <Link class="hover:text-pb-dark-grey" href="/matches"
                    >Matches</Link
                >
                <Link v-if="!user" class="hover:text-pb-dark-grey" href="/login"
                    >Login</Link
                >

                <div v-if="user" class="">
                    <a class="hover:text-pb-dark-grey" href="/dashboard">
                        <UserLogo
                            class="inline w-6 h-6 mr-2 hover:stroke-pb-dark-grey"
                        />
                        <p class="inline">{{ user.first_name }}</p>
                    </a>
                </div>
            </div>

            <div
                class="hidden lg:flex bg-pb-yellow relative items-center font-bold gap-2 text-pb-soft-grey"
            >
                <Link class="hover:text-pb-dark-grey" href="/"
                    >Leaderboard</Link
                >
                <Link class="hover:text-pb-dark-grey" href="/matches"
                    >Matches</Link
                >
                <Link v-if="!user" class="hover:text-pb-dark-grey" href="/login"
                    >Login</Link
                >

                <div v-if="user" class="">
                    <a class="hover:text-pb-dark-grey" href="/dashboard">
                        <UserLogo
                            class="inline w-6 h-6 mr-2 hover:stroke-pb-dark-grey"
                        />
                        <p class="inline">{{ user.first_name }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
