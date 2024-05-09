<script setup>
import PongBirdLogo from "./PongbirdLogo.vue";
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
                <a class="hover:text-pb-dark-grey" href="/login">Login</a>
            </div>
        </div>
    </div>
</template>
