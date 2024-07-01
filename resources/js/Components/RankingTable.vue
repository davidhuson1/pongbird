<script setup>
import { usePage } from "@inertiajs/vue3";
import EmptyProfileImage from "../../images/empty_profile_image.webp";
import arrowUp from "../../images/arrow_up.png";
import arrowDown from "../../images/arrow_down2.png";
import winnerIcon from "../../images/winner.svg";

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
                    class="w-full p-2 border-b bg-pb-light-grey"
                    :class="{
                        'bg-neutral-50/50': [0, 1, 2].includes(index),
                    }"
                >
                    {{ index + 1 }}
                </div>
                <div
                    class="bg-pb-light-grey w-full p-2 flex flex-row border-b justify-between lg:px-20 text-ellipsis"
                    :class="{
                        'font-bold': index === 0,
                        'bg-neutral-50/50': [0, 1, 2].includes(index),
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
                        class="inline my-auto ml-2 h-4 l-4 md:h-6 md:w-6"
                        :src="winnerIcon"
                    />
                </div>
                <div
                    class="flex flex-row justify-start pl-[20%] w-full p-2 border-b bg-pb-light-grey"
                    :class="{
                        'bg-neutral-50/50': [0, 1, 2].includes(index),
                    }"
                >
                    <div class="">{{ item.rating }}</div>
                    <div class="md:ml-2 text-xs text-pb-soft-grey">
                        <img
                            v-if="item.latest_rating_change > 0"
                            class="inline h-3 w-3"
                            :src="arrowUp"
                        />
                        <img
                            v-else-if="item.latest_rating_change < 0"
                            class="inline h-3 w-3"
                            :src="arrowDown"
                        />
                        {{
                            item.latest_rating_change != 0
                                ? item.latest_rating_change
                                : ""
                        }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
