<script setup>
import MatchHistoryTable from "../Components/MatchHistoryTable.vue";
import Navbar from "../Components/Navbar.vue";
import NewMatchForm from "../Components/NewMatchForm.vue";
</script>

<template>
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8">
            <NewMatchForm class="mb-8" />
            <MatchHistoryTable />
        </div>
    </main>
</template>
