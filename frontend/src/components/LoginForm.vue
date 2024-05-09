<script setup>
import { ref } from "vue";
const username = ref("");
const password = ref("");
</script>

<template>
    <div class="rounded-md">
        <div class="bg-white shadow-md p-8 w-1/2 mx-auto">
            <div class="p-2 text-center text-xl w-full">Login</div>
            <div class="p-2">
                <div class="w-full pb-1">
                    <label for="" class="form-label">Email</label>
                </div>
                <div class="w-full">
                    <input
                        type="email"
                        class="p-1 px-2 border rounded-md w-full"
                        name=""
                        id=""
                        aria-describedby="emailHelpId"
                        placeholder="user@email.com"
                    />
                </div>
            </div>
            <div class="p-2">
                <div class="w-full pb-1">
                    <label for="" class="form-label">Password</label>
                </div>
                <div class="w-full">
                    <input
                        type="password"
                        class="p-1 px-2 border rounded-sm w-full"
                        name=""
                        id=""
                        placeholder="*********"
                    />
                </div>
            </div>

            <div class="pt-8 text-center">
                <button
                    class="bg-pb-yellow hover:bg-pb-yellow-dark text-white w-full font-bold py-2 px-6 rounded"
                >
                    Login
                </button>
                <div class="pt-2 text-pb-soft-grey">
                    Don't have an account?
                    <a
                        class="hover:text-pb-dark-grey underline"
                        href="/register"
                        >Sign up</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
