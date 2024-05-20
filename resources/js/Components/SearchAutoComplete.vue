<script setup>
import { ref } from "vue";

const props = defineProps({
    items: {
        type: Object,
        required: true,
    },
});

console.log(props.items);

const searchString = ref("");
const results = ref([]);
const isOpen = ref(false);

const filterResults = () => {
    results.value = props.items.filter(
        (item) =>
            item.toLowerCase().indexOf(searchString.value.toLowerCase()) > -1
    );
};

const onChange = () => {
    console.log("change");
    filterResults();
    isOpen.value = true;
    console.log(results.value);
};

const setResult = (result) => {
    searchString.value = result;
    isOpen.value = false;
};
</script>

<template>
    <div class="relative">
        <input
            class="p-1 px-2 border rounded-sm w-full"
            v-model="searchString"
            @input="onChange"
            type="text"
            placeholder="Opponent A"
        />
        <ul
            v-if="isOpen"
            class="bg-white w-full my-2 absolute max-h-[50vh] overflow-auto"
        >
            <li
                v-for="(result, i) in results"
                :key="i"
                @click="setResult(result)"
                class="p-4 text-pb-soft-grey hover:text-white hover:bg-gray-600"
            >
                {{ result }}
            </li>
        </ul>
    </div>
</template>

<style lang="scss" scoped></style>
