<script setup>
import { usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import EmptyProfileImage from "../../images/empty_profile_image.webp";

const page = usePage();
const user = computed(() => page.props.auth.user ?? null);
console.log(user.value.profile_picture);
const profileImage = ref(
    user.value.profile_picture ? user.value.profile_picture : EmptyProfileImage
);
</script>

<template>
    <a class="hover:text-pb-dark-grey" href="/dashboard">
        <div class="flex flex-row">
            <div>
                <img
                    class="h-6 w-6 rounded-full mr-1 border-[1.5px] border-pb-soft-grey"
                    alt="Profile Image"
                    :src="profileImage"
                />
            </div>
            <div>{{ user.first_name }}</div>
        </div>
    </a>
</template>
