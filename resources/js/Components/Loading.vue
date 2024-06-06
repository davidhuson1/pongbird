<script setup>
import LoadingAnimation from "../../images/loading.gif";
</script>

<template>
    <div
        class="bg-slate-500/50 flex h-full justify-center items-center z-20"
        id="loading"
    >
        <img class="img" :src="LoadingAnimation" alt="loading..." width="200" />
    </div>
</template>
