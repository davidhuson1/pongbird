<script setup>
import { reactive, ref } from "vue";
import axios from "axios";

const credentials = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
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
        .post("/register", credentials)
        .then((response) => {
            if (response.status === 200) {
                success.value = true;
                window.location.href = "/login";
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
            <div class="p-2 text-center text-xl w-full">Register</div>
            <div class="p-2">
                <div class="w-full pb-2">
                    <input
                        v-model="credentials.name"
                        type="name"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Name"
                    />
                </div>

                <div class="w-full pb-2">
                    <input
                        v-model="credentials.email"
                        type="email"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Email"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        v-model="credentials.password"
                        type="password"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Password"
                    />
                </div>
                <div class="w-full pb-2">
                    <input
                        v-model="credentials.password_confirmation"
                        type="password"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="Confirm password"
                    />
                </div>
                <p v-if="errors" class="text-red-500">{{ errors }}</p>
                <p v-if="success" class="text-green-500">
                    Account successfully created!
                </p>
            </div>

            <div class="pt-8 text-center">
                <button
                    @click.prevent="hanldeSignUp()"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Create account
                </button>
                <div class="pt-2 text-pb-soft-grey">
                    Already have an account?
                    <a class="hover:text-pb-dark-grey underline" href="/login"
                        >Sign in</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
