<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed } from "vue";
import EmptyProfileImage from "../../images/empty_profile_image.webp";

const page = usePage();
const user = computed(() => page.props.auth.user);

const handleLogout = async () => {
    console.log(" logout");

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    await axiosInstance
        .post("logout")
        .then((response) => {
            if (response.status === 200) {
                router.visit("/");
                return response.data;
            }
        })
        .catch((error) => {
            console.log("errors:", error.message);
        });
};
</script>

<template>
    <div class="bg-white mx-auto rounded-md">
        <div class="my-4 w-full shadow-md">
            <div class="p-2 text-center text-xl w-full border-double border-b">
                Dashboard of {{ user.first_name }}
            </div>
            <div class="block p-4 lg:flex lg:flex-row gap-4 justify-between">
                <div class="w-full lg:w-1/2">
                    <div class="p-2 flex text-start">
                        <div class="w-full font-bold">Name</div>
                        <div class="w-full">{{ user.first_name }}</div>
                    </div>
                    <div class="p-2 flex">
                        <div class="w-full font-bold">Email</div>
                        <div class="w-full">{{ user.email }}</div>
                    </div>
                    <div class="p-2 flex">
                        <div class="w-full font-bold">Current rank</div>
                        <div class="w-full">?</div>
                    </div>

                    <button
                        @click.prevent="handleLogout()"
                        class="flex flex-row shadow-md justify-center bg-gray-300 hover:bg-gray-100 border-pb-yellow w-full font-bold py-3 px-6 my-4 rounded"
                    >
                        Logout
                        <div class="inline w-6 h-6">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                                />
                            </svg>
                        </div>
                    </button>
                </div>
                <div class="w-full lg:w-1/2">
                    <img class="w-full shadow-md" :src="EmptyProfileImage" />
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
