<script setup>
import { usePage } from "@inertiajs/vue3";
import winnerIcon from "../../images/winner.svg";
import EmptyProfileImage from "../../images/empty_profile_image.webp";

const userRankings = usePage().props.users;
</script>

<template>
    <div class="bg-white mx-auto rounded-md text-pb-dark-grey">
        <div class="w-full shadow-md">
            <div class="p-3 flex font-semibold border-b-2 text-center">
                <div class="w-full">Rank</div>
                <div class="w-full">Player</div>
                <div class="w-full">Rating</div>
            </div>
            <div v-for="(item, index) in userRankings" class="flex text-center">
                <div
                    class="w-full p-2 border-b"
                    :class="{
                        ' bg-pb-light-grey': [0, 1, 2].includes(index),
                    }"
                >
                    {{ index + 1 }}
                </div>
                <div
                    class="w-full p-2 flex flex-row border-b justify-between lg:px-20 text-ellipsis"
                    :class="{
                        'font-bold': index === 0,
                        ' bg-pb-light-grey': [0, 1, 2].includes(index),
                    }"
                >
                    <img
                        :src="
                            item.profile_picture
                                ? item.profile_picture
                                : EmptyProfileImage
                        "
                        class="hidden md:block h-16 mr-2"
                    />
                    {{ item.name }}
                    <img
                        v-if="index === 0"
                        class="inline h-6 w-6"
                        :src="winnerIcon"
                    />
                </div>
                <div
                    class="w-full p-2 border-b"
                    :class="{
                        ' bg-pb-light-grey': [0, 1, 2].includes(index),
                    }"
                >
                    {{ item.rating }}
                </div>
            </div>
        </div>
    </div>
</template>
