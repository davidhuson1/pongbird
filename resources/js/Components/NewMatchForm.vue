<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import SearchAutoComplete from "./SearchAutoComplete.vue";

const matchData = reactive({
    opponent_a: "",
    opponent_b: "",
    score_opponent_a: "",
    score_opponent_b: "",
});
const errors = ref(null);
const success = ref(false);

const hanldeSignUp = () => {
    errors.value = null;
    success.value = false;

    const axiosInstance = axios.create({
        baseURL: "http://localhost/api",
        headers: {},
    });

    axiosInstance
        .post("/match/create", matchData)
        .then((response) => {
            if (response.status === 200) {
                success.value = true;
                window.location.href = "/matches";
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
        <div class="bg-white shadow-md p-8 lg:w-1/2 mx-auto">
            <div class="p-2 text-center text-xl w-full">New Match</div>
            <div class="flex gap-2">
                <div class="w-full pb-2">
                    <SearchAutoComplete
                        :items="[
                            'Apple',
                            'Banana',
                            'Orange',
                            'Mango',
                            'Pear',
                            'Peach',
                            'Grape',
                            'Tangerine',
                            'Pineapple',
                        ]"
                    />
                    <input
                        v-model="matchData.opponent_a"
                        type="name"
                        class="p-1 px-2 border rounded-sm w-full"
                        name="Opponent A"
                        id="OpponentA"
                        placeholder="Opponent A"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        v-model="matchData.opponent_b"
                        type="name"
                        class="p-1 px-2 border rounded-sm w-full"
                        name="Opponnent B"
                        id="OpponentB"
                        placeholder="Opponent B"
                    />
                </div>
            </div>
            <div class="flex gap-2">
                <div class="w-full pb-2">
                    <input
                        v-model="matchData.score_opponent_a"
                        type="number"
                        class="p-1 px-2 border rounded-sm w-full"
                        name="Score opponent A"
                        id="ScoreA"
                        placeholder="Score A"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        v-model="matchData.score_opponent_b"
                        type="number"
                        class="p-1 px-2 border rounded-sm w-full"
                        name="Score opponent B"
                        id="ScoreB"
                        placeholder="Score B"
                    />
                </div>
            </div>
            <p v-if="errors" class="text-red-500">{{ errors }}</p>
            <p v-if="success" class="text-green-500">
                Account successfully created!
            </p>
            <div class="pt-8 text-center">
                <button
                    @click.prevent="hanldeNewMatch()"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Submit new match
                </button>
            </div>
        </div>
    </div>
</template>
