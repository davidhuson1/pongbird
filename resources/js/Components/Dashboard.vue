<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import EmptyProfileImage from "../../images/empty_profile_image.webp";
import Loading from "./Loading.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
const isLoading = ref(false);

const profileImage = ref(EmptyProfileImage);
const newProfileImage = ref(null);
const progress = ref("");
const uploadStatus = ref(false);

const handleLogout = async () => {
    isLoading.value = true;
    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });

    await axiosInstance
        .post("logout")
        .then((response) => {
            isLoading.value = false;
            if (response.status === 200) {
                router.visit("/");
                return response.data;
            }
        })
        .catch((error) => {
            isLoading.value = false;
            console.log("errors:", error.message);
        });
};

const handleImageUpload = async () => {
    uploadStatus.value = true;

    const image = newProfileImage.value.files[0];
    const formData = new FormData();
    formData.append("image", image);

    const axiosInstance = axios.create({
        baseURL: "/",
        headers: { "Content-Type": "multipart-formdata" },
        onUploadProgress: (progressEvent) => {
            progress.value = Math.round(
                (progressEvent.loaded * 100) / progressEvent.total
            );
        },
    });

    await axiosInstance
        .post("upload-profile-image", formData)
        .then((response) => {
            uploadStatus.value = false;

            profileImage.value = response.data.url;
        })
        .catch((error) => {
            uploadStatus.value = false;
            console.log("errors:", error.message);
        });
};
</script>

<template>
    <div class="bg-white mx-auto rounded-md">
        <Loading v-if="isLoading" class="absolute top-0 left-0 w-full h-full" />
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
                        class="flex flex-row font-medium shadow-md justify-center bg-gray-300 hover:bg-gray-100 border-pb-yellow w-full lg:w-1/2 py-3 px-6 my-4 rounded"
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
                <div class="w-full lg:w-1/3">
                    <img class="w-full shadow-md mb-6" :src="profileImage" />
                    <div>
                        <label
                            class="cursor-pointer text-sm w-full lg:w-fit font-medium shadow-md bg-pb-yellow hover:bg-pb-yellow-dark py-3 px-6 my-4 rounded"
                            for="image-upload"
                            >Upload profile picture</label
                        >
                        <input
                            ref="newProfileImage"
                            id="image-upload"
                            style="visibility: hidden"
                            type="file"
                            @change="handleImageUpload()"
                        />
                    </div>

                    <!-- <input
                        type="file"
                        ref="myImage"
                        id="image-upload"
                        class="text-sm w-full lg:w-fit font-medium shadow-md bg-pb-yellow hover:bg-pb-yellow-dark py-3 px-6 my-4 rounded"
                        @change="handleImageUpload()"
                    /> -->
                    <!-- <button
                        @click.prevent="handleImageUpload()"
                        class="text-sm w-full lg:w-fit font-medium shadow-md bg-pb-yellow hover:bg-pb-yellow-dark py-3 px-6 my-4 rounded"
                    >
                        Upload profile picture
                    </button> -->
                    <div v-if="uploadStatus" class="my-4">
                        <div class="progress py-3">
                            <div
                                class="progress-bar bg-pb-yellow"
                                role="progressbar"
                                :style="{ width: `${progress}%` }"
                                :aria-valuenow="progress"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                Uploading... {{ progress }}
                            </div>
                        </div>
                    </div>
                    <p id="errors"></p>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
