<script setup>
import { ref } from "vue";

const score = ref(null);

defineProps({
    disabled: {
        type: Boolean,
        default: false,
    },
    placeholder: {
        type: String,
        default: "",
    },
});

const emit = defineEmits(["setScore", "inputError"]);

const onChange = () => {
    if (!Number.isInteger(score.value)) {
        emit("inputError", "Score must be an integer");
        score.value = Number(score.value);
    } else {
        emit("inputError", null);
        emit("setScore", score.value);
    }
};
</script>
<template>
    <div>
        <input
            v-model="score"
            @input="onChange()"
            type="number"
            class="p-1 px-2 border rounded-sm w-full"
            name="Score"
            id="Score"
            :placeholder="placeholder"
            :disabled="disabled"
            :class="{ 'bg-gray-100': disabled }"
        />
    </div>
</template>

<style lang="scss" scoped></style>
