<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/vue3";
const page = usePage();

const matches = computed(() => page.props.matches.data);

console.log(matches.value);
</script>

<template>
    <div class="bg-white mx-auto rounded-md">
        <div class="w-full shadow-md">
            <div class="p-2 text-center text-xl w-full border-double border-b">
                Matches
            </div>
            <div class="p-2 flex font-bold border-b">
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
