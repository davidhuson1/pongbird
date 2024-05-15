<script setup>
import { ref } from "vue";

const data = ref([
    {
        rank: 1,
        name: "David Huson",
        rating: 9000,
    },
    {
        rank: 2,
        name: "Jan Jansen",
        rating: 8000,
    },
    {
        rank: 3,
        name: "Piet Pietersen",
        rating: 7000,
    },
    {
        rank: 4,
        name: "Annetje Annetjesen",
        rating: 5000,
    },
    {
        rank: 5,
        name: "Karel Karelsen",
        rating: 2000,
    },
]);
</script>

<template>
    <div class="bg-white mx-auto rounded-md">
        <div class="w-full shadow-md">
            <div class="p-2 text-center text-xl w-full border-double border-b">
                Leaderboard
            </div>
            <div class="p-2 flex font-bold border-b">
                <div class="w-full text-center">Rank</div>
                <div class="w-full text-center">Player</div>
                <div class="w-full text-center">Rating</div>
            </div>
            <div v-for="(item, index) in data" class="flex">
                <div class="w-full text-center p-2 border-b">
                    {{ index + 1 }}
                </div>
                <div class="w-full text-center p-2 border-b">
                    {{ item.name }}
                </div>
                <div class="w-full text-center p-2 border-b">
                    {{ item.rating }}
                </div>
            </div>
        </div>
    </div>
</template>
