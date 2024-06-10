<script setup>
import { usePage, router } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import EmptyProfileImage from "../../images/empty_profile_image.webp";
import Loading from "./Loading.vue";

const page = usePage();
const user = computed(() => page.props.auth.user);
const isLoading = ref(false);
const errors = ref(null);

console.log(user.value.profile_picture);

const profileImage = ref(
    user.value.profile_picture ? user.value.profile_picture : EmptyProfileImage
);

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
            errors.value = error.response.data.message;
        });
};

const handleImageDelete = async () => {
    isLoading.value = true;
    const axiosInstance = axios.create({
        baseURL: "/",
        headers: {},
    });
    await axiosInstance
        .get("delete-profile-image")
        .then((response) => {
            isLoading.value = false;
            profileImage.value = EmptyProfileImage;
        })
        .catch((error) => {
            isLoading.value = false;
            errors.value = error.response.data.message;
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
                    <div class="flex gap-2 flex-row">
                        <div>
                            <label
                                class="block cursor-pointer text-sm w-full lg:w-fit font-medium shadow-md bg-pb-yellow hover:bg-pb-yellow-dark py-3 px-6 my-4 rounded"
                                for="image-upload"
                                >Upload profile picture</label
                            >
                        </div>
                        <input
                            ref="newProfileImage"
                            id="image-upload"
                            class="hidden"
                            type="file"
                            @change="handleImageUpload()"
                        />
                        <button
                            v-if="profileImage !== EmptyProfileImage"
                            class="cursor-pointer text-sm max-w-fit lg:w-content font-medium shadow-md bg-gray-300 hover:bg-gray-100 py-3 px-6 my-4 rounded"
                            @click="handleImageDelete()"
                        >
                            <svg
                                width="20px"
                                height="20px"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M13 4H8.8C7.11984 4 6.27976 4 5.63803 4.32698C5.07354 4.6146 4.6146 5.07354 4.32698 5.63803C4 6.27976 4 7.11984 4 8.8V15.2C4 16.8802 4 17.7202 4.32698 18.362C4.6146 18.9265 5.07354 19.3854 5.63803 19.673C6.27976 20 7.11984 20 8.8 20H15.2C16.8802 20 17.7202 20 18.362 19.673C18.9265 19.3854 19.3854 18.9265 19.673 18.362C20 17.7202 20 16.8802 20 15.2V11"
                                    stroke="#000000"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M4 16L8.29289 11.7071C8.68342 11.3166 9.31658 11.3166 9.70711 11.7071L13 15M13 15L15.7929 12.2071C16.1834 11.8166 16.8166 11.8166 17.2071 12.2071L20 15M13 15L15.25 17.25"
                                    stroke="#000000"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                                <path
                                    d="M17 3L19 5M21 7L19 5M19 5L21 3M19 5L17 7"
                                    stroke="#000000"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                />
                            </svg>
                        </button>
                    </div>

                    <div v-if="uploadStatus" class="my-4">
                        <div class="progress">
                            Uploading...
                            <div
                                class="progress-bar bg-pb-yellow"
                                role="progressbar"
                                :style="{ width: `${progress}%` }"
                                :aria-valuenow="progress"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                {{ progress }}
                            </div>
                        </div>
                    </div>
                    <div v-if="errors" class="text-red-500 mt-4">
                        {{ errors }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
