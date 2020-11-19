<template>
    <section class="my-12">
        <v-container>
            <v-row no-gutters>
                <v-col v-for="service in services" :key="service.icon" cols="4">
                    <v-row no-gutters>
                        <v-col cols="4">
                            <div class="icon-holder">
                                <v-icon
                                    color="primary"
                                    class="service-icon"
                                    v-text="service.icon"
                                ></v-icon>
                            </div>
                        </v-col>

                        <v-col cols="8">
                            <v-card flat>
                                <v-card-title
                                    v-text="service.title"
                                ></v-card-title>
                                <v-card-text
                                    v-text="service.text"
                                ></v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
export default {
    name: "Services",

    data: () => ({
        services: [
            {
                icon: "mdi-truck-outline",
                title: "Free Shipping Worlwide",
                text: "Lorem Ipsum Is Simply Dummy Text Lorem Ipsum."
            },
            {
                icon: "mdi-headset",
                title: "24/7 Customer Service",
                text: "Lorem Ipsum Is Simply Dummy Text Lorem Ipsum."
            },
            {
                icon: "mdi-currency-usd-circle-outline",
                title: "Money Back Garantee",
                text: "Lorem Ipsum Is Simply Dummy Text Lorem Ipsum."
            }
        ]
    })
};
</script>

<style scoped>
.service-icon {
    font-size: 50px;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.icon-holder {
    display: inline-block;
    position: relative;
    width: 112px;
    height: 112px;
    border: 3px solid rgba(0, 0, 0, 0.12);
    border-radius: 50%;
}
</style>
