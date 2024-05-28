<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import SearchAutoComplete from "./SearchAutoComplete.vue";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import { router } from "@inertiajs/vue3";
import ScoreInput from "./ScoreInput.vue";

const page = usePage();
const users = computed(() => page.props.users);

const matchData = reactive({
    opponent_a: "",
    opponent_b: "",
    score_opponent_a: "",
    score_opponent_b: "",
});
const errors = ref(null);
const success = ref(false);

const hanldeCreateMatch = () => {
    errors.value = null;
    success.value = false;

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    axiosInstance
        .post("matches", matchData)
        .then((response) => {
            if (response.status === 201) {
                success.value = true;
                router.reload({ only: ["matches"] });
                // window.location.href = "/matches";
                return response.data;
            }
        })
        .catch((error) => {
            console.log(error.message);
            errors.value = error.response.data.message;
        });
};
</script>

<template>
    <div class="rounded-md">
        <div class="bg-white text-pb-dark-grey shadow-md p-8 lg:w-1/2 mx-auto">
            <div class="p-2 text-center text-lg w-full pb-8">New Match</div>
            <div class="flex gap-2">
                <div class="w-full pb-2">
                    <SearchAutoComplete
                        :disabled="success"
                        :placeholder="'Opponent A'"
                        v-model="matchData.opponent_a"
                        @set-opponent="
                            (opponent) => (matchData.opponent_a = opponent)
                        "
                        :users="users"
                    />
                </div>
                <div class="w-full pb-2">
                    <SearchAutoComplete
                        :disabled="success"
                        :placeholder="'Opponent B'"
                        v-model="matchData.opponent_b"
                        @set-opponent="
                            (opponent) => (matchData.opponent_b = opponent)
                        "
                        :users="users"
                    />
                </div>
            </div>
            <div class="flex gap-2">
                <div class="w-full pb-2">
                    <ScoreInput
                        :disabled="success"
                        :placeholder="'Score A'"
                        :class="{ 'bg-gray-100': success }"
                        @set-score="
                            (score) => (matchData.score_opponent_a = score)
                        "
                        @input-error="(inputError) => (errors = inputError)"
                    />
                </div>
                <div class="w-full pb-2">
                    <ScoreInput
                        :disabled="success"
                        :placeholder="'Score B'"
                        :class="{ 'bg-gray-100': success }"
                        @set-score="
                            (score) => (matchData.score_opponent_b = score)
                        "
                        @input-error="(inputError) => (errors = inputError)"
                    />
                </div>
            </div>
            <p v-if="errors" class="text-red-500">{{ errors }}</p>
            <p v-if="success" class="text-green-500">Match recorded! 🏓</p>
            <div class="pt-8 text-center">
                <button
                    v-if="!success"
                    @click.prevent="hanldeCreateMatch()"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark w-full font-bold py-2 px-6 rounded"
                >
                    Submit new match
                </button>
                <button
                    v-else
                    @click="() => router.visit('/matches')"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark w-full font-bold py-2 px-6 rounded"
                >
                    Submit another match
                </button>
            </div>
        </div>
    </div>
</template>
