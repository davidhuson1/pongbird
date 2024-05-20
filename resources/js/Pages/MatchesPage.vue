<script setup>
import Navbar from "../Components/Navbar.vue";
import NewMatchForm from "../Components/NewMatchForm.vue";
</script>

<template>
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8">
            <NewMatchForm />
        </div>
    </main>
</template>
