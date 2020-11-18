<template>
    <section>
        <v-carousel cycle height="489" hide-delimiters show-arrows-on-hover>
            <v-carousel-item v-for="(slide, i) in slides" :key="i">
                <v-sheet color="white" light outlined height="100%">
                    <v-row class="fill-height" align="center" justify="end">
                        <v-col cols="4">
                            <v-card flat>
                                <v-card-title
                                    class="display-3 primary--text slider-title"
                                    v-text="slide.title"
                                >
                                </v-card-title>
                                <v-card-text v-text="slide.text"></v-card-text>
                                <v-card-actions>
                                    <v-btn
                                        color="primary"
                                        tile
                                        large
                                        width="150"
                                        >shop now</v-btn
                                    >
                                </v-card-actions>
                            </v-card>
                        </v-col>
                        <v-col cols="6">
                            <v-img
                                :src="slide.image"
                                :width="i === 0 ? '70%' : '100%'"
                            ></v-img>
                        </v-col>
                    </v-row>
                </v-sheet>
            </v-carousel-item>
        </v-carousel>
    </section>
</template>

<script>
import banner1 from "@/assets/main-banner-1.png";
import banner2 from "@/assets/main-banner-2.png";

export default {
    name: "Slider",

    data: () => ({
        slides: [
            {
                title: "Smart eco bee system",
                image: banner1,
                text:
                    "Lorem ipsum dolor, sit amet consectetur adipisicing elit."
            },
            {
                title: "Smart Led CCTV system",
                image: banner2,
                text:
                    "Lorem ipsum dolor, sit amet consectetur adipisicing elit."
            }
        ]
    })
};
</script>

<style scoped>
.slider-title {
    font-weight: 900;
    word-break: normal;
}
</style>
