<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";

const page = usePage();
const matches = computed(() => page.props.matches.data);
</script>

<template>
    <div class="bg-white text-pb-dark-grey mx-auto rounded-md">
        <div class="w-full shadow-md">
            <div
                class="p-2 text-center text-lg w-full font-semibold border-b-2"
            >
                Matches
            </div>
            <div class="p-2 flex font-medium border-b-2">
                <div class="w-full text-center">Opponent A</div>
                <div class="w-full text-center">Opponent B</div>
                <div class="w-full text-center">Score</div>
                <div class="w-full text-center">Winner</div>
                <div class="w-full text-center">Date</div>
            </div>
            <div
                v-for="(match, index) in matches.slice().reverse()"
                class="flex"
            >
                <div class="w-full text-center p-2 border-b">
                    {{ match.attributes.opponent_a.name }}
                </div>
                <div class="w-full text-center p-2 border-b">
                    {{ match.attributes.opponent_b.name }}
                </div>
                <div class="w-full text-center p-2 border-b">
                    {{ match.attributes.opponent_a.score }} -
                    {{ match.attributes.opponent_b.score }}
                </div>
                <div class="w-full text-center p-2 border-b">
                    {{ match.attributes.winner }}
                </div>

                <div class="w-full text-center p-2 border-b">
                    {{ match.attributes.created_at }}
                </div>
            </div>
        </div>
    </div>
</template>
