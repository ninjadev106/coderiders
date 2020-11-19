<template>
    <section>
        <v-row no-gutters class="border">
            <v-col
                v-for="banner in banners"
                :key="banner.id"
                cols="4"
                style="position: relative"
            >
                <v-img :src="banner.image"></v-img>
                <v-card tile flat dark class="sub-banner-info">
                    <v-card-title
                        class="display-1"
                        style="word-break: normal"
                        v-text="banner.title"
                    />
                    <v-card-text>
                        <router-link
                            :to="`/products/${banner.id}`"
                            class="white--text"
                        >
                            discover More
                        </router-link>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </section>
</template>

<script>
import banner1 from "@/assets/sub-banner-1.jpg";
import banner2 from "@/assets/sub-banner-2.jpg";
import banner3 from "@/assets/sub-banner-3.jpg";

export default {
    name: "SubBanners",

    data: () => ({
        banners: [
            { id: 1, title: "Smoke Alarm", image: banner1 },
            { id: 2, title: "Thermo State", image: banner2 },
            { id: 3, title: "Video Cam", image: banner3 }
        ]
    })
};
</script>

<style scoped>
.sub-banner-info {
    position: absolute;
    top: 50%;
    left: 60%;
    transform: translateY(-50%);
    background: transparent;
}
</style>
