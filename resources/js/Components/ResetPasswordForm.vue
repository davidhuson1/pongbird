<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import { Link, router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

const page = usePage();

const credentials = reactive({
    email: "",
    password: "",
    password_confirmation: "",
    token: page.props.token,
});
const errors = ref(null);
const success = ref(false);

const hanldeSetNewPassword = () => {
    errors.value = null;

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    axiosInstance
        .post("reset-password", credentials)
        .then((response) => {
            if (response.status === 200) {
                success.value = true;
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
            <div class="p-2 text-center text-xl w-full">
                Set your new password
            </div>
            <div class="p-2">
                <div class="w-full pb-2">
                    <input
                        :disabled="success"
                        v-model="credentials.email"
                        type="email"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Email"
                        :class="{ 'bg-gray-100': success }"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        :disabled="success"
                        v-model="credentials.password"
                        type="password"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Password"
                        :class="{ 'bg-gray-100': success }"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        :disabled="success"
                        v-model="credentials.password_confirmation"
                        type="password"
                        class="p-1 px-2 border rounded-sm w-full"
                        :class="{ 'bg-gray-100': success }"
                        name=""
                        id=""
                        placeholder="Confirm password"
                    />
                </div>
                <input
                    v-model="credentials.token"
                    type="password"
                    class="hidden p-1 px-2 border rounded-sm w-full"
                    name="token"
                    id="token"
                    placeholder="Token"
                />
                <p v-if="errors" class="text-red-500">{{ errors }}</p>
                <p v-if="success" class="text-green-500">
                    New password successfully set!
                </p>
            </div>

            <div class="pt-8 text-center">
                <button
                    v-if="success"
                    @click.prevent="router.visit('/login')"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Sign in with your new password
                </button>
                <button
                    v-else
                    @click.prevent="hanldeSetNewPassword()"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Set new password
                </button>
            </div>
        </div>
    </div>
</template>
