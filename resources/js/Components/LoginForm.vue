<script setup>
import { reactive, ref } from "vue";
import axios from "axios";
import { Link, router } from "@inertiajs/vue3";

const errors = ref(null);
const success = ref(false);

const credentials = reactive({
    email: "",
    password: "",
    remember: false,
});

const handleLogin = async () => {
    errors.value = null;
    success.value = false;

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    await axiosInstance
        .post("login", credentials)
        .then((response) => {
            if (response.status === 200) {
                success.value = true;
                router.visit("dashboard");
                return response.data;
            }
        })
        .catch((error) => {
            console.log("errors:", error.message);
            errors.value = error.response.data.message;
        });
};
</script>

<template>
    <div class="rounded-md">
        <div class="bg-white shadow-md p-8 lg:w-1/2 mx-auto">
            <div class="p-2 text-center text-xl w-full">Login</div>
            <div class="p-2">
                <div class="w-full pb-1">
                    <label for="email" class="form-label">Email</label>
                </div>
                <div class="w-full">
                    <input
                        v-model="credentials.email"
                        type="email"
                        class="p-1 px-2 border rounded-md w-full"
                        name="email"
                        id="email"
                        aria-describedby="emailHelpId"
                        placeholder="user@email.com"
                    />
                </div>
            </div>
            <div class="p-2">
                <div class="w-full pb-1">
                    <label for="password" class="form-label">Password</label>
                </div>
                <div class="w-full pb-4">
                    <input
                        v-model="credentials.password"
                        type="password"
                        class="p-1 px-2 border rounded-md w-full"
                        name="password"
                        id="password"
                        placeholder="*********"
                    />
                </div>
                <div class="flex justify-between">
                    <label for="remember" class="form-label"
                        >Remember me?</label
                    >
                    <input
                        v-model="credentials.remember"
                        type="checkbox"
                        class="p-1 px-2 border rounded-sm mr-1"
                        name="remember"
                        id="remember"
                    />
                </div>
                <p v-if="errors" class="text-red-500">{{ errors }}</p>
                <p v-if="success" class="text-green-500">
                    Successfully logged in!
                </p>
            </div>

            <div class="pt-6 text-center">
                <button
                    @click.prevent="handleLogin()"
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Login
                </button>
                <div class="pt-2 text-pb-soft-grey">
                    Don't have an account?
                    <Link
                        class="hover:text-pb-dark-grey underline"
                        href="/signup"
                        >Sign up
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
