<template>
    <v-footer app dark absolute color="primary" class="pa-0">
        <v-container class="py-9">
            <v-row justify="center">
                <v-col cols="9" class="mt-12">
                    <router-link to="/">
                        <v-img
                            src="../assets/footer-logo.png"
                            width="207"
                            height="65"
                            contain
                            style="margin: auto"
                        ></v-img>
                    </router-link>
                    <v-card-text class="text-center my-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Inventore laudantium illo obcaecati. Quas laudantium
                        perferendis omnis impedit similique accusamus delectus
                        ipsum consequuntur, saepe aliquid veniam optio sed
                        earum. Magnam, atque.
                    </v-card-text>
                </v-col>

                <v-col cols="4">
                    <v-card color="secondary" class="pb-10">
                        <v-card-title
                            style="justify-content: center"
                            class="pb-3"
                        >
                            <v-col cols="12" class="text-center pb-0 pt-2">
                                Social Media
                            </v-col>

                            <v-col cols="11">
                                <v-divider></v-divider>
                            </v-col>
                        </v-card-title>

                        <v-row no-gutters justify="center">
                            <v-btn icon large>
                                <v-icon>mdi-facebook</v-icon>
                            </v-btn>
                            <v-btn icon large>
                                <v-icon>mdi-twitter</v-icon>
                            </v-btn>
                            <v-btn icon large>
                                <v-icon>mdi-linkedin</v-icon>
                            </v-btn>
                            <v-btn icon large>
                                <v-icon>mdi-instagram</v-icon>
                            </v-btn>
                            <v-btn icon large>
                                <v-icon>mdi-google-plus</v-icon>
                            </v-btn>
                        </v-row>

                        <v-row no-gutters justify="center" class="mt-5">
                            <v-col cols="auto">
                                <v-img
                                    src="../assets/discover.jpg"
                                    width="46"
                                ></v-img>
                            </v-col>
                            <v-col cols="auto" class="mx-2">
                                <v-img
                                    src="../assets/master-card.png"
                                    width="46"
                                ></v-img>
                            </v-col>
                            <v-col cols="auto" class="mr-2">
                                <v-img
                                    src="../assets/paypal.jpg"
                                    width="46"
                                ></v-img>
                            </v-col>
                            <v-col cols="auto">
                                <v-img
                                    src="../assets/visa.jpg"
                                    width="46"
                                ></v-img>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>

                <v-col cols="4">
                    <v-card color="secondary" class="pb-10">
                        <v-card-title
                            style="justify-content: center"
                            class="pb-4"
                        >
                            <v-col cols="12" class="text-center pb-0 pt-2">
                                Contact Us
                            </v-col>

                            <v-col cols="11">
                                <v-divider></v-divider>
                            </v-col>
                        </v-card-title>

                        <v-card-text class="pa-0">
                            <p class="ma-0 text-center">
                                60, 29th Street, San Francisco, CA 94110,
                            </p>
                            <p class="ma-0 text-center">
                                United States of America
                            </p>
                            <p class="ma-0 text-center">
                                Phone : (+00) 123-456-789
                            </p>
                            <p class="ma-0 text-center">
                                E-mail : demo@example.com
                            </p>
                        </v-card-text>
                    </v-card>
                </v-col>

                <v-col cols="4">
                    <v-card color="secondary" class="pb-10">
                        <v-card-title
                            style="justify-content: center"
                            class="pb-3"
                        >
                            <v-col cols="12" class="text-center pb-0 pt-2">
                                Sign Up For Newsletter
                            </v-col>

                            <v-col cols="11">
                                <v-divider></v-divider>
                            </v-col>
                        </v-card-title>

                        <v-row no-gutters justify="center">
                            <v-col cols="10" class="px-3">
                                <v-text-field
                                    class="b-tile"
                                    outlined
                                    dense
                                    hide-details
                                ></v-text-field>

                                <v-btn
                                    block
                                    color="white"
                                    light
                                    tile
                                    large
                                    class="mt-2"
                                    >subscribe</v-btn
                                >
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>
            </v-row>

            <v-row justify="center" class="mt-12">
                <v-col cols="12" class="text-center">
                    <router-link
                        v-for="link in links"
                        :key="link.title"
                        :to="link.to"
                        v-text="link.title"
                        class="white--text text-capitalize mx-3"
                    >
                    </router-link>
                </v-col>

                <v-col class="text-center">
                    Copyright &copy; {{ new Date().getFullYear() }} UpStar.inc
                </v-col>
            </v-row>
        </v-container>
    </v-footer>
</template>

<script>
export default {
    name: "AppFooter",

    data: () => ({
        links: [
            { title: "Home", to: "/" },
            { title: "Shop", to: "/shop" },
            { title: "Blog", to: "/blog" },
            { title: "About Us", to: "/about" },
            { title: "Contact Us", to: "/contact" }
        ]
    })
};
</script>
