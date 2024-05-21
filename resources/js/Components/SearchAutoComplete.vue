<script setup>
import { ref } from "vue";

const props = defineProps({
    users: {
        type: Object,
        required: true,
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["setOpponent"]);

console.log(props.users);

const searchString = ref("");
const results = ref([]);
const isOpen = ref(false);
const error = ref("");

const filterResults = () => {
    results.value = props.users.filter(
        (user) =>
            user.name.toLowerCase().indexOf(searchString.value.toLowerCase()) >
            -1
    );

    if (results.value.length === 0) {
        error.value = "Opponent not found...🙄";
    }
};

const onChange = () => {
    error.value = "";
    filterResults();
    isOpen.value = true;
};

const onSetOpponent = (result) => {
    searchString.value = result.name;
    emit("setOpponent", result.id);
    isOpen.value = false;
};
</script>

<template>
    <div class="relative">
        <input
            class="p-1 px-2 border rounded-sm w-full"
            :class="{ 'bg-gray-100': disabled }"
            v-model="searchString"
            @input="onChange"
            type="text"
            placeholder="Opponent A"
            :disabled="disabled"
        />
        <ul v-if="error" class="w-full">
            <li>
                <p class="p-4 text-red-500">{{ error }}</p>
            </li>
        </ul>
        <ul
            v-if="isOpen"
            class="bg-gray-100 w-full mb-2 mt-1 absolute max-h-[50vh] overflow-auto"
        >
            <li
                v-for="(result, i) in results"
                :key="i"
                @click="onSetOpponent(result)"
                class="p-4 text-pb-soft-grey hover:text-white hover:bg-gray-600"
            >
                {{ result.name }}
            </li>
        </ul>
    </div>
</template>

<style lang="scss" scoped></style>
