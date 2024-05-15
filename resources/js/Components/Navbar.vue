<script setup>
import axios from "axios";
import PongBirdLogo from "./PongbirdLogo.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import UserLogo from "./UserLogo.vue";

const page = usePage();

const user = computed(() => page.props.auth.user ?? null);

const handleLogout = async () => {
    console.log(" logout");

    const axiosInstance = axios.create({
        baseURL: "http://localhost:8000/",
        headers: {},
    });

    await axiosInstance
        .post("logout")
        .then((response) => {
            if (response.status === 200) {
                window.location.href = "/";
                return response.data;
            }
        })
        .catch((error) => {
            console.log("errors:", error.message);
        });
};
</script>

<template>
    <div class="flex justify-between bg-pb-yellow p-4">
        <div class="container flex justify-between">
            <div class="flex items-center font-bold gap-2 text-pb-soft-grey">
                <PongBirdLogo />
                <div class="text-2xl">Pongbird</div>
            </div>
            <div class="flex items-center font-bold gap-2 text-pb-soft-grey">
                <a class="hover:text-pb-dark-grey" href="/">Leaderboard</a>
                <a class="hover:text-pb-dark-grey" href="/matches">Matches</a>
                <a v-if="!user" class="hover:text-pb-dark-grey" href="/login"
                    >Login</a
                >
                <button v-if="user" @click.prevent="handleLogout()">
                    Logout
                </button>
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
