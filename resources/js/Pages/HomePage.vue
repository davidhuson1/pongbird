<script setup>
import Navbar from "../Components/Navbar.vue";
import RankingTable from "../Components/RankingTable.vue";
import NewMatchButton from "../Components/NewMatchButton.vue";
import { usePage } from "@inertiajs/vue3";
import Loading from "../Components/Loading.vue";

const user = usePage().props.auth.user;
const isLoading = false;
</script>

<template>
    <main class="bg-pb-light-grey">
        <Loading v-if="isLoading" class="absolute top-0 left-0 w-full h-full" />

        <Navbar />
        <div class="min-h-screen container py-8 relative">
            <RankingTable />
            <NewMatchButton
                v-if="user"
                class="fixed bottom-8 right-0 translate-x-[-17%] md:translate-x-0 w-[75%] md:w-max md:right-16"
            />
        </div>
    </main>
</template>
