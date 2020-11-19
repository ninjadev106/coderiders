<template>
    <section>
        <v-container>
            <v-divider style="margin: 150px 0 40px"></v-divider>

            <v-row justify="center">
                <v-col cols="9">
                    <v-card-title class="display-3 primary--text main-title">
                        <v-col class="text-center pa-0">
                            New Arrival
                        </v-col>
                    </v-card-title>
                    <v-card-text class="text-center my-5">
                        Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing Elit,
                        Sed Do Eiusmod Tempor Incididunt Ut Labore Et Dolore
                        Magna Aliqua. Ut Enim Ad Minim Veniam
                    </v-card-text>
                </v-col>
            </v-row>

            <v-row>
                <v-col
                    v-for="product in products"
                    :key="product.id"
                    cols="3"
                    style="position: relative"
                >
                    <div class="icon-holder">
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <v-btn dark color="primary" icon v-on="on">
                                    <v-icon class="pointer"
                                        >mdi-eye-outline</v-icon
                                    >
                                </v-btn>
                            </template>

                            <span>quick view</span>
                        </v-tooltip>

                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <v-btn dark color="primary" icon v-on="on">
                                    <v-icon class="pointer"
                                        >mdi-heart-outline</v-icon
                                    >
                                </v-btn>
                            </template>

                            <span>make favorite</span>
                        </v-tooltip>

                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <v-btn dark color="primary" icon v-on="on">
                                    <v-icon class="pointer"
                                        >mdi-cart-outline</v-icon
                                    >
                                </v-btn>
                            </template>

                            <span>add to cart</span>
                        </v-tooltip>
                    </div>
                    <v-img
                        :src="product.images[0]"
                        height="400"
                        class="pointer"
                    ></v-img>
                    <v-rating
                        v-model="product.rating"
                        color="orange"
                        class="my-2"
                        half-increments
                        readonly
                    ></v-rating>
                    <div class="pl-2" v-text="product.title"></div>
                    <div class="price">£{{ product.price.toFixed(2) }}</div>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
import img4 from "@/assets/products/4.jpg";
import img5 from "@/assets/products/5.jpg";
import img6 from "@/assets/products/6.jpg";
import img7 from "@/assets/products/7.jpg";
import img8 from "@/assets/products/8.jpg";
import img9 from "@/assets/products/9.jpg";
import img10 from "@/assets/products/10.jpg";
import img11 from "@/assets/products/11.jpg";
import img12 from "@/assets/products/12.jpg";
import img13 from "@/assets/products/13.jpg";
import img14 from "@/assets/products/14.jpg";
import img15 from "@/assets/products/15.jpg";
import img16 from "@/assets/products/16.jpg";
import img17 from "@/assets/products/17.jpg";
import img18 from "@/assets/products/18.jpg";
import img19 from "@/assets/products/19.jpg";

export default {
    name: "NewArrival",

    data: () => ({
        products: [
            {
                id: 1,
                title: "Beautifully Design Red Dress",
                price: 150,
                rating: 4,
                images: [img9, img10, img11, img12, img13, img14]
            },
            {
                id: 2,
                title: "Stretchable Jeans",
                price: 88,
                rating: 3.5,
                images: [img13, img14, img15, img16, img17, img18]
            },
            {
                id: 3,
                title: "Peacock Design Kurti",
                price: 70,
                rating: 1,
                images: [img14, img15, img16, img17, img18, img19]
            },
            {
                id: 4,
                title: "Dapibus in Scalf",
                price: 35,
                rating: 2,
                images: [img4, img5, img6, img7, img8, img9]
            }
        ]
    })
};
</script>

<style scoped>
.main-title {
    font-weight: 900;
    word-break: normal;
}

.price {
    padding-left: 8px;
    color: #0e1932;
    font-size: 22px;
    font-weight: bold;
}

.pointer {
    cursor: pointer;
}

.icon-holder {
    position: absolute;
    top: 14px;
    right: 14px;
    z-index: 5;
}

.bxo {
    background-color: #f2f2f2;
    height: 100px;
}

.bxo2 {
    background-color: #ffffff;
    height: 100px;
}
</style>
