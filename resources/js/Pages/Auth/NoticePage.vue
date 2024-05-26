<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import Navbar from "../../Components/Navbar.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";

const user = usePage().props.auth.user;
const errors = ref(null);
const success = ref(false);

function hanldeResendLink() {
    errors.value = null;

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    axiosInstance
        .post("email/verification-notification")
        .then((response) => {
            if (response.status === 200) {
                success.value = true;
            }
        })
        .catch((error) => {
            console.log(error.message);
            errors.value = error.response.data.message;
        });
}
</script>

<template>
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8 text-center">
            <div class="rounded-md">
                <div class="bg-white shadow-md p-8 lg:w-1/2 mx-auto">
                    <div class="p-2 text-center text-xl w-full">
                        Verify your email address
                    </div>
                    <div v-if="!success" class="p-2">
                        <div class="w-full pb-2">
                            You're almost there! We have sent a verification
                            link to
                        </div>
                        <div class="w-full font-bold mb-2">
                            {{ user.email }}
                        </div>

                        <div class="w-full pb-2">
                            Click on the link to complete the verification
                            process
                        </div>
                    </div>
                    <p v-if="errors" class="text-red-500">{{ errors }}</p>
                    <p v-if="success" class="text-green-500 pt-2">
                        Email succesfully sent!
                    </p>

                    <div class="pt-8 text-center">
                        <button
                            v-if="!success"
                            @click.prevent="hanldeResendLink()"
                            class="bg-pb-yellow pt hover:bg-pb-yellow-dark text-pb-dark-grey w-full font-bold py-2 px-6 rounded"
                        >
                            Resend email
                        </button>
                        <div class="pt-2 text-pb-soft-grey">
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
