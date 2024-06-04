<script setup>
import Navbar from "../../Components/Navbar.vue";
import RegisterForm from "../../Components/RegisterForm.vue";
import ResetPasswordForm from "../../Components/ResetPasswordForm.vue";
</script>

<template>
    <main class="bg-pb-light-grey">
        <Navbar />
        <div class="min-h-screen container pt-8">
            <ResetPasswordForm />
        </div>
    </main>
</template>
