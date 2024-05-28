<script setup>
import Navbar from "../Components/Navbar.vue";
import RankingTable from "../Components/RankingTable.vue";
import NewMatchButton from "../Components/NewMatchButton.vue";
import { usePage } from "@inertiajs/vue3";

const user = usePage().props.auth.user;
</script>

<template>
    <main class="bg-pb-light-grey">
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
