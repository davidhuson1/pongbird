<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Navbar from "../../Components/Navbar.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
const errors = ref(null);
const success = ref(false);

const credentials = ref({
    email: "",
});

const handleSendResetLink = () => {
    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    axiosInstance
        .post("forgot-password", credentials.value)
        .then((response) => {
            if (response.status === 200) {
                errors.value = null;
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
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8 text-center">
            <div class="rounded-md">
                <div class="bg-white shadow-md p-8 lg:w-1/2 mx-auto">
                    <div class="p-2 text-center text-xl w-full">
                        {{ success ? "Check your mail" : "Forgot password? " }}
                    </div>
                    <div v-if="!success" class="p-2">
                        <div class="w-full pb-2">
                            Enter your email to reset your password
                        </div>
                        <div class="w-full">
                            <input
                                v-model="credentials.email"
                                type="email"
                                class="p-1 px-2 border rounded-md w-full lg:w-1/2"
                                name="email"
                                id="email"
                                placeholder="user@email.com"
                            />
                        </div>
                    </div>
                    <p v-if="errors" class="text-red-500">{{ errors }}</p>
                    <p v-if="success" class="text-green-500 pt-2">
                        Reset link succesfully sent!
                    </p>

                    <div class="pt-8 text-center">
                        <button
                            v-if="!success"
                            @click.prevent="handleSendResetLink()"
                            class="bg-pb-yellow pt hover:bg-pb-yellow-dark text-pb-dark-grey w-full font-bold py-2 px-6 rounded"
                        >
                            Send reset link
                        </button>
                        <div class="pt-8 text-pb-soft-grey">
                            Need help?
                            <Link
                                class="hover:text-pb-dark-grey underline"
                                href="/contact"
                                >Contact us
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
