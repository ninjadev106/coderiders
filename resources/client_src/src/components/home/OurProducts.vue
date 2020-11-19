<template>
    <section>
        <v-container>
            <v-row justify="center">
                <v-col cols="9">
                    <v-card-title class="display-3 primary--text main-title">
                        <v-col class="text-center pa-0">
                            Our Products
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
                    <v-card tile flat @click="myFunc(product.id)">
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
                    </v-card>
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

            <v-row justify="center">
                <v-btn color="primary" large class="mt-5" tile
                    >load more products</v-btn
                >
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
import img20 from "@/assets/products/20.jpg";
import img21 from "@/assets/products/21.jpg";

export default {
    name: "OurProducts",

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
            },
            {
                id: 5,
                title: "Maroon Shorty",
                price: 98,
                rating: 0,
                images: [img19, img20, img13, img7, img16, img10]
            },
            {
                id: 6,
                title: "Maroon Shorty",
                price: 98,
                rating: 5,
                images: [img7, img8, img9, img10, img11, img12]
            },
            {
                id: 7,
                title: "Antique Short Dress",
                price: 88,
                rating: 0,
                images: [img17, img16, img18, img19, img20, img21]
            },
            {
                id: 8,
                title: "Black Lowest Jeans",
                price: 110,
                rating: 3.5,
                images: [img10, img11, img12, img13, img14, img15]
            }
        ]
    }),

    methods: {
        myFunc(id) {
            this.$router.push(`/products/${id}`);
        }
    }
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
    top: 4px;
    right: 4px;
    z-index: 5;
}
</style>
