<template>
    <v-card tile outlined>
        <v-toolbar flat>
            <v-toolbar-title>Products</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn outlined color="primary" class="mr-5" @click="open(1)"
                >new product</v-btn
            >
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="products"
            disable-sort
            class="border-top"
        >
            <template v-slot:item.images="{ item }">
                <v-img
                    :src="'http://localhost:3000/' + item.images[0]"
                    width="10vw"
                ></v-img>
            </template>

            <template v-slot:item.action="{ item }">
                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-icon
                            class="mr-2"
                            color="yellow darken-3"
                            v-on="on"
                            @click="open(2, item)"
                            >mdi-pencil-outline</v-icon
                        >
                    </template>

                    <span>Update</span>
                </v-tooltip>

                <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                        <v-icon color="red" v-on="on" @click="remove(item._id)"
                            >mdi-delete-outline</v-icon
                        >
                    </template>

                    <span>Delete</span>
                </v-tooltip>
            </template>
        </v-data-table>

        <v-dialog v-model="dialog" max-width="50%" persistent>
            <v-form v-model="valid" ref="form" @submit.prevent="save">
                <v-card>
                    <v-card-title>{{ title }}</v-card-title>

                    <v-container>
                        <v-row no-gutters justify="space-around">
                            <v-col cols="5">
                                <v-text-field
                                    v-model="product.title"
                                    class="b-tile"
                                    label="title"
                                    outlined
                                    dense
                                    clearable
                                    :rules="titleRules"
                                    :success="titleSuccess"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="5">
                                <v-text-field
                                    v-model="product.category.name"
                                    class="b-tile"
                                    label="category"
                                    outlined
                                    dense
                                    readonly
                                    :rules="categoryRules"
                                    :success="categorySuccess"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="11">
                                <v-card class="mb-5" outlined tile>
                                    <v-window v-model="step">
                                        <v-window-item :value="1">
                                            <v-card-title
                                                class="title font-weight-regular justify-space-between"
                                            >
                                                <span>Category</span>
                                                <v-avatar
                                                    color="primary lighten-2"
                                                    class="subheading white--text"
                                                    size="24"
                                                    v-text="step"
                                                ></v-avatar>
                                            </v-card-title>

                                            <v-list>
                                                <v-list-item-group
                                                    v-model="selectedCategory"
                                                >
                                                    <v-list-item
                                                        v-for="category in categories"
                                                        :key="category._id"
                                                        :value="category"
                                                        @click="step++"
                                                    >
                                                        <v-list-item-title
                                                            v-text="
                                                                category.name
                                                            "
                                                        ></v-list-item-title>
                                                    </v-list-item>
                                                </v-list-item-group>
                                            </v-list>
                                        </v-window-item>

                                        <v-window-item
                                            v-if="selectedCategory"
                                            :value="2"
                                        >
                                            <v-card-title
                                                class="title font-weight-regular justify-space-between"
                                            >
                                                <v-btn
                                                    icon
                                                    @click="
                                                        () => {
                                                            selectedCategory = {};
                                                            step--;
                                                        }
                                                    "
                                                >
                                                    <v-icon
                                                        >mdi-arrow-left</v-icon
                                                    >
                                                </v-btn>
                                                <span
                                                    v-text="
                                                        selectedCategory.name
                                                    "
                                                ></span>
                                                <v-avatar
                                                    color="primary lighten-2"
                                                    class="subheading white--text"
                                                    size="24"
                                                    v-text="step"
                                                ></v-avatar>
                                            </v-card-title>

                                            <v-list>
                                                <v-list-item-group
                                                    v-model="
                                                        secondSelectedCategory
                                                    "
                                                >
                                                    <v-list-item
                                                        v-for="category in selectedCategory.children"
                                                        :key="category._id"
                                                        :value="category"
                                                        @click="step++"
                                                    >
                                                        <v-list-item-title
                                                            v-text="
                                                                category.name
                                                            "
                                                        ></v-list-item-title>
                                                    </v-list-item>
                                                </v-list-item-group>
                                            </v-list>
                                        </v-window-item>

                                        <v-window-item
                                            v-if="secondSelectedCategory"
                                            :value="3"
                                        >
                                            <v-card-title
                                                class="title font-weight-regular justify-space-between"
                                            >
                                                <v-btn
                                                    icon
                                                    @click="
                                                        () => {
                                                            secondSelectedCategory = {};
                                                            step--;
                                                        }
                                                    "
                                                >
                                                    <v-icon
                                                        >mdi-arrow-left</v-icon
                                                    >
                                                </v-btn>
                                                <span
                                                    v-text="
                                                        secondSelectedCategory.name
                                                    "
                                                ></span>
                                                <v-avatar
                                                    color="primary lighten-2"
                                                    class="subheading white--text"
                                                    size="24"
                                                    v-text="step"
                                                ></v-avatar>
                                            </v-card-title>

                                            <v-list>
                                                <v-list-item-group
                                                    v-model="
                                                        thirdSelectedCategory
                                                    "
                                                    color="primary"
                                                >
                                                    <v-list-item
                                                        v-for="category in secondSelectedCategory.children"
                                                        :key="category._id"
                                                        :value="category"
                                                    >
                                                        <v-list-item-title
                                                            v-text="
                                                                category.name
                                                            "
                                                        ></v-list-item-title>
                                                    </v-list-item>
                                                </v-list-item-group>
                                            </v-list>
                                        </v-window-item>
                                    </v-window>

                                    <v-divider></v-divider>
                                </v-card>
                            </v-col>

                            <v-col cols="5">
                                <v-text-field
                                    v-model.number="product.price"
                                    type="number"
                                    class="b-tile"
                                    label="price"
                                    outlined
                                    dense
                                    clearable
                                    :rules="priceRules"
                                    :success="priceSuccess"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="5">
                                <v-text-field
                                    v-model.number="product.rating"
                                    type="number"
                                    class="b-tile"
                                    label="rating"
                                    outlined
                                    dense
                                    clearable
                                    :rules="ratingRules"
                                    :success="ratingSuccess"
                                ></v-text-field>
                            </v-col>

                            <v-col cols="11">
                                <v-file-input
                                    class="b-tile"
                                    label="upload product images"
                                    dense
                                    outlined
                                    multiple
                                    :error-messages="
                                        !product.images.length
                                            ? 'Images are required'
                                            : ''
                                    "
                                    :success="product.images.length"
                                    @change="onFileSelected"
                                ></v-file-input>
                            </v-col>

                            <v-col cols="11" class="pa-0">
                                <v-row>
                                    <v-col
                                        cols="4"
                                        v-for="image in product.images"
                                        :key="image"
                                    >
                                        <v-card tile outlined>
                                            <v-img :src="image"></v-img>
                                        </v-card>
                                    </v-col>
                                </v-row>
                            </v-col>
                            <v-col cols="12">
                                <v-alert
                                    v-if="errorMessage"
                                    type="error"
                                    class="mx-2"
                                    >{{ errorMessage }}</v-alert
                                >
                            </v-col>
                        </v-row>
                    </v-container>

                    <v-divider></v-divider>

                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn text @click="dialog = false">cancel</v-btn>
                        <v-btn
                            :disabled="disabled"
                            type="submit"
                            color="success"
                            width="90"
                            @click="save"
                            >save</v-btn
                        >
                    </v-card-actions>
                </v-card>
            </v-form>
        </v-dialog>
    </v-card>
</template>

<script>
import Product from "../../models/Product";

export default {
    name: "Products",
    data() {
        return {
            headers: [
                { text: "Title", value: "title" },
                { text: "Price", value: "price" },
                { text: "Rating", value: "rating" },
                { text: "Image", value: "images" },
                { text: "Actions", value: "action" }
            ],
            products: [],
            product: new Product(),
            categories: [],
            mode: 0,
            dialog: false,
            valid: false,
            step: 1,
            selectedCategory: {},
            secondSelectedCategory: {},
            thirdSelectedCategory: {},
            titleSuccess: false,
            titleRules: [
                v => {
                    if (v) {
                        this.titleSuccess = true;
                        return true;
                    } else {
                        return "Title is required";
                    }
                },
                v =>
                    (v || "").length >= 3 ||
                    "Title must be at least 3 characters long",
                v =>
                    (v || "").length <= 20 ||
                    "Title must be less than 20 characters"
            ],
            categorySuccess: false,
            categoryRules: [
                v => {
                    if (v) {
                        this.categorySuccess = true;
                        return true;
                    } else {
                        return "Category is required";
                    }
                }
            ],
            priceSuccess: false,
            priceRules: [
                v => {
                    if (v + "") {
                        this.priceSuccess = true;
                        return true;
                    } else {
                        return "Price is required";
                    }
                },
                v => v > 0 || "Price must be greater 0"
            ],
            ratingSuccess: false,
            ratingRules: [
                v => {
                    if (v + "") {
                        this.ratingSuccess = true;
                        return true;
                    } else {
                        return "Rating is required";
                    }
                },
                v => v >= 0 || "Rating must be 0 to 5",
                v => v <= 5 || "Rating must be less then 5"
            ],
            errorMessage: "",
            snackbar: false,
            disabled: true
        };
    },

    computed: {
        title() {
            return this.mode === 1 ? "New Product" : "Update Product";
        }
    },

    methods: {
        getProducts() {
            Product.get()
                .then(res => (this.products = res.data))
                .catch(err => console.error(err.response.data));
        },

        getCategories() {
            this.$axios
                .get(`/api/categories`)
                .then(res => (this.categories = res.data))
                .catch(err => console.error(err.response.data));
        },

        open(mode, item) {
            this.product = new Product(item);
            this.selectedCategory = {};
            this.secondSelectedCategory = {};
            this.thirdSelectedCategory = {};
            this.step = 1;
            if (mode === 1) {
                this.titleSuccess = false;
                this.categorySuccess = false;
                this.priceSuccess = false;
                this.ratingSuccess = false;
            }
            if (mode === 2) {
                this.product.images = this.product.images.map(
                    image =>
                        "https://evening-headland-21583.herokuapp.com/" + image
                );
            }
            this.mode = mode;
            this.dialog = true;
            setTimeout(() => this.$refs.form.resetValidation(), 300);
        },

        save() {
            this.disabled = true;

            if (this.mode === 1) {
                Product.post(this.product)
                    .then(res => {
                        this.products.push(res.data);
                        this.dialog = false;
                        this.disabled = false;
                    })
                    .catch(err => {
                        this.errorMessage = err.response.data;
                        setTimeout(() => (this.errorMessage = ""), 5000);
                        this.disabled = false;
                    });
            } else {
                Product.put(this.product)
                    .then(res => {
                        let index = this.products.findIndex(
                            p => p._id === res.data._id
                        );
                        this.products.splice(index, 1, res.data);
                        this.dialog = false;
                        this.disabled = false;
                    })
                    .catch(err => {
                        this.errorMessage = err.response.data;
                        setTimeout(() => (this.errorMessage = ""), 5000);
                        this.disabled = false;
                    });
            }
        },

        remove(id) {
            Product.delete(id)
                .then(res => {
                    let index = this.products.findIndex(
                        p => p._id === res.data._id
                    );
                    this.products.splice(index, 1);
                })
                .catch(err => {
                    this.errorMessage = err.response.data;
                    this.snackbar = true;
                    setTimeout(() => {
                        this.snackbar = false;
                        this.errorMessage = "";
                    }, 5000);
                });
        },

        onFileSelected(event) {
            this.product.imageFiles = event;

            this.product.imageFiles.forEach(imageFile => {
                const reader = new FileReader();
                reader.readAsDataURL(imageFile);
                reader.onload = e => this.product.images.push(e.target.result);
            });
        }
    },

    watch: {
        valid(val) {
            if (val) {
                this.disabled = false;
            } else {
                this.disabled = true;
            }
        },

        thirdSelectedCategory(val) {
            if (val) {
                this.product.category = val;
            } else {
                this.product.category = {};
            }
        }
    },

    mounted() {
        this.getCategories();
        this.getProducts();
    }
};
</script>
