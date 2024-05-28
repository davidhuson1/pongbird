<script setup>
import { usePage } from "@inertiajs/vue3";

const userRankings = usePage().props.users;
</script>

<template>
    <div class="bg-white mx-auto rounded-md text-pb-dark-grey">
        <div class="w-full shadow-md">
            <div class="p-3 flex font-semibold border-b-2 text-center">
                <div class="w-full">Rank</div>
                <div class="w-full">Player</div>
                <div class="w-full">Rating</div>
            </div>
            <div v-for="(item, index) in userRankings" class="flex text-center">
                <div class="w-full p-2 border-b">
                    {{ index + 1 }}
                </div>
                <div class="w-full p-2 border-b">
                    {{ item.name }}
                </div>
                <div class="w-full p-2 border-b">
                    {{ item.rating }}
                </div>
            </div>
        </div>
    </div>
</template>
