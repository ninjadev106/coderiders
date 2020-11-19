<template>
    <v-container fluid class="pa-0">
        <v-sheet color="grey lighten-3" height="131">
            <v-card-title class="primary--text main-title">
                <v-col cols="12" class="text-center">
                    Shop
                </v-col>
                <v-breadcrumbs
                    :items="breadcrumbs"
                    class="pa-0"
                    style="margin: auto"
                ></v-breadcrumbs>
            </v-card-title>
        </v-sheet>

        <v-container>
            <v-row>
                <v-col cols="3" class="pa-0">
                    <v-card tile outlined>
                        <v-card-title
                            class="py-2 px-5 grey lighten-3 primary--text"
                            >Shop by category</v-card-title
                        >

                        <v-list>
                            <v-list-group
                                v-for="category in categories"
                                :key="category.title"
                                v-model="category.active"
                                no-action
                            >
                                <template v-slot:activator>
                                    <v-list-item-content>
                                        <v-list-item-title
                                            v-text="category.title"
                                        ></v-list-item-title>
                                    </v-list-item-content>
                                </template>

                                <v-list-item
                                    v-for="subItem in category.items"
                                    :key="subItem.title"
                                >
                                    <v-list-item-content>
                                        <v-list-item-title
                                            v-text="subItem.title"
                                        ></v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-list-group>
                        </v-list>
                    </v-card>

                    <v-card tile outlined class="mt-12">
                        <v-card-title
                            class="py-2 px-5 grey lighten-3 primary--text"
                            >Filter by price</v-card-title
                        >

                        <v-range-slider
                            v-model="priceRange"
                            :min="minPrice"
                            :max="maxPrice"
                            class="mt-3 mx-5"
                        ></v-range-slider>

                        <v-btn color="primary" tile class="mx-5">filter</v-btn>

                        <div
                            class="mt-3 mx-5 primary--text"
                            style="font-weight: bold"
                        >
                            Price: £{{ priceRange[0] }} — £{{ priceRange[1] }}
                        </div>
                    </v-card>

                    <v-card tile outlined class="mt-12">
                        <v-card-title
                            class="py-2 px-5 grey lighten-3 primary--text"
                            >Top rated products</v-card-title
                        >

                        <v-row
                            v-for="product in topRated"
                            :key="product.id"
                            justify="center"
                            class="pointer"
                        >
                            <v-col cols="4">
                                <v-img
                                    :src="product.images[0]"
                                    height="100"
                                ></v-img>
                            </v-col>
                            <v-col cols="7">
                                <span style="font-size: 14px">{{
                                    product.title
                                }}</span>
                                <v-rating
                                    v-model="product.rating"
                                    color="orange"
                                    half-increments
                                    readonly
                                    small
                                    style="margin-left: -10px"
                                ></v-rating>
                                <span
                                    style="font-size: 14px"
                                    class="primary--text"
                                    >£{{ product.price }}</span
                                >
                            </v-col>
                        </v-row>
                    </v-card>
                </v-col>

                <v-col cols="9" class="pt-0">
                    <v-row no-gutters>
                        <v-col>
                            <v-btn-toggle v-model="viewType" mandatory tile>
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn v-on="on">
                                            <v-icon
                                                >mdi-view-grid-outline</v-icon
                                            >
                                        </v-btn>
                                    </template>

                                    <span>grid view</span>
                                </v-tooltip>

                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on }">
                                        <v-btn v-on="on">
                                            <v-icon
                                                >mdi-format-list-bulleted</v-icon
                                            >
                                        </v-btn>
                                    </template>

                                    <span>list view</span>
                                </v-tooltip>
                            </v-btn-toggle>
                        </v-col>

                        <v-col cols="4">
                            <v-select
                                v-model="sortType"
                                :items="sortTypes"
                                item-value="id"
                                menu-props="offsetY"
                                color="primary"
                                item-color="primary"
                                class="b-tile"
                                outlined
                                dense
                            ></v-select>
                        </v-col>
                    </v-row>

                    <v-row>
                        <v-col
                            v-for="product in products"
                            :key="product.id"
                            cols="4"
                            style="position: relative"
                        >
                            <v-card tile flat @click="myFunc(product.id)">
                                <div class="icon-holder">
                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                dark
                                                color="primary"
                                                icon
                                                v-on="on"
                                            >
                                                <v-icon class="pointer"
                                                    >mdi-eye-outline</v-icon
                                                >
                                            </v-btn>
                                        </template>

                                        <span>quick view</span>
                                    </v-tooltip>

                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                dark
                                                color="primary"
                                                icon
                                                v-on="on"
                                            >
                                                <v-icon class="pointer"
                                                    >mdi-heart-outline</v-icon
                                                >
                                            </v-btn>
                                        </template>

                                        <span>make favorite</span>
                                    </v-tooltip>

                                    <v-tooltip bottom>
                                        <template v-slot:activator="{ on }">
                                            <v-btn
                                                dark
                                                color="primary"
                                                icon
                                                v-on="on"
                                            >
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
                            <div class="price">
                                £{{ product.price.toFixed(2) }}
                            </div>
                        </v-col>
                    </v-row>
                    <div class="text-center mt-3">
                        <v-pagination
                            v-model="page"
                            :total-visible="10"
                            :length="5"
                        ></v-pagination>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </v-container>
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
    name: "Shop",

    data: () => ({
        viewType: 0,
        breadcrumbs: [
            {
                text: "Home",
                disabled: false,
                to: "/"
            },
            {
                text: "Shop",
                disabled: false,
                to: "/shop"
            }
        ],

        categories: [
            {
                title: "Attractions",
                items: [{ title: "List Item" }]
            },
            {
                title: "Dining",
                items: [
                    { title: "Breakfast & brunch" },
                    { title: "New American" },
                    { title: "Sushi" }
                ]
            },
            {
                title: "Education",
                items: [{ title: "List Item" }]
            },
            {
                title: "Family",
                items: [{ title: "List Item" }]
            },
            {
                title: "Health",
                items: [{ title: "List Item" }]
            },
            {
                title: "Office",
                items: [{ title: "List Item" }]
            },
            {
                title: "Promotions",
                items: [{ title: "List Item" }]
            }
        ],

        sortType: 1,

        sortTypes: [
            { id: 1, text: "Default sorting" },
            { id: 2, text: "Sort by popularity" },
            { id: 3, text: "Sort by average rating" },
            { id: 4, text: "Sort by latest" },
            { id: 5, text: "Sort by price: low to high" },
            { id: 6, text: "Sort by price: high to low" }
        ],

        priceRange: [30, 150],
        minPrice: 30,
        maxPrice: 150,

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
        ],

        topRated: [
            {
                id: 1,
                title: "Beautifully Design Red Dress",
                price: 150,
                rating: 5,
                images: [img9, img10, img11, img12, img13, img14]
            },
            {
                id: 2,
                title: "Stretchable Jeans",
                price: 88,
                rating: 4,
                images: [img13, img14, img15, img16, img17, img18]
            },
            {
                id: 3,
                title: "Peacock Design Kurti",
                price: 70,
                rating: 4.5,
                images: [img14, img15, img16, img17, img18, img19]
            }
        ],

        page: 1
    }),

    watch: {
        sortType(val) {
            console.log(val);
        }
    },

    methods: {}
};
</script>

<style scoped>
.main-title {
    font-size: 30px;
    font-weight: bold;
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
