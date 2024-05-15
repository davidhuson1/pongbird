<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
</script>

<template>
    <div class="bg-white mx-auto rounded-md">
        <div class="w-full shadow-md">
            <div class="p-2 text-center text-xl w-full border-double border-b">
                Dashboard of {{ user.first_name }}
            </div>
            <div class="m-4 flex flex-row justify-between">
                <div class="w-1/2">
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
                </div>
                <div class="w-1/2 font-bold">
                    <a class="" href="/logout">
                        <p class="inline">Logout</p>
                        <div class="w-6 h-6">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="inlinew-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"
                                />
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
