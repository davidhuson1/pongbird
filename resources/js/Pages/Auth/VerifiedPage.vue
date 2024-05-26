<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Navbar from "../../Components/Navbar.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
</script>

<template>
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8 text-center">
            <div class="rounded-md">
                <div class="bg-white shadow-md p-8 lg:w-1/2 mx-auto">
                    <div class="p-2 text-center text-xl w-full">
                        Welcome {{ user.name }} to Pongbird
                    </div>
                    <div class="p-2">
                        <div class="w-full pb-2">
                            Your account has been verified
                        </div>
                    </div>
                    <Link
                        href="/"
                        class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                    >
                        Go to leaderboard
                    </Link>
                </div>
            </div>
        </div>
    </main>
</template>
