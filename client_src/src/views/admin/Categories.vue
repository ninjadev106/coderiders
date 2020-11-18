<template>
    <v-card tile outlined>
        <v-snackbar v-model="snackbar" top color="red darken-4">
            <v-alert type="error" class="ma-0">
                {{ errorMessage }}
            </v-alert>

            <template v-slot:action="{ attrs }">
                <v-btn
                    icon
                    class="mr-2"
                    v-bind="attrs"
                    @click="snackbar = false"
                >
                    <v-icon>mdi-close</v-icon>
                </v-btn>
            </template>
        </v-snackbar>

        <v-toolbar flat>
            <v-toolbar-title>
                Categories
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn outlined color="primary" class="mr-5" @click="open(1)"
                >new category</v-btn
            >
        </v-toolbar>

        <v-container fluid class="border-top">
            <v-row justify="space-between">
                <v-col cols="6">
                    <v-treeview
                        v-model="selectedCategory"
                        :items="categories"
                        :selectable="dialog && mode === 1"
                        item-key="_id"
                        selected-color="primary"
                        selection-type="independent"
                    >
                        <template v-slot:append="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon>
                                        <v-icon
                                            color="yellow darken-3"
                                            v-on="on"
                                            @click="open(2, item)"
                                            >mdi-pencil-outline</v-icon
                                        >
                                    </v-btn>
                                </template>

                                <span>Update</span>
                            </v-tooltip>

                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon>
                                        <v-icon
                                            color="red"
                                            v-on="on"
                                            @click="remove(item._id)"
                                            >mdi-delete-outline</v-icon
                                        >
                                    </v-btn>
                                </template>

                                <span>Delete</span>
                            </v-tooltip>
                        </template>
                    </v-treeview>
                </v-col>

                <v-col cols="4">
                    <v-row no-gutters justify="end">
                        <v-col cols="12">
                            <v-form
                                v-if="dialog"
                                v-model="valid"
                                @submit.prevent="save"
                            >
                                <v-card outlined tile>
                                    <v-card-title>
                                        <v-col class="text-center">
                                            {{ title }}
                                        </v-col>
                                    </v-card-title>

                                    <v-row no-gutters justify="center">
                                        <v-col cols="11">
                                            <v-text-field
                                                v-model="category.name"
                                                class="b-tile"
                                                label="category"
                                                outlined
                                                dense
                                                clearable
                                            ></v-text-field>
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

                                    <v-divider></v-divider>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>
                                        <v-btn text @click="dialog = false"
                                            >cancel</v-btn
                                        >
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
                                <v-alert v-if="mode === 1" type="info" tile
                                    >If no category choosen, category will be
                                    added at root level</v-alert
                                >
                            </v-form>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </v-container>
    </v-card>
</template>

<script>
import Category from "../../models/Category";

export default {
    name: "Products",
    data: () => ({
        headers: [
            { text: "Title", value: "title" },
            { text: "Actions", value: "action" }
        ],
        categories: [],
        category: new Category(),
        selectedCategory: [],
        mode: 0,
        dialog: false,
        valid: false,
        errorMessage: "",
        snackbar: false,
        disabled: false
    }),

    computed: {
        title() {
            return this.mode === 1 ? "New Category" : "Update Category";
        }
    },

    methods: {
        getCategories() {
            Category.get()
                .then(res => (this.categories = res.data))
                .catch(err => console.error(err.response.data));
        },

        open(mode, item) {
            this.category = new Category(item);
            console.log(this.category);
            this.mode = mode;
            this.dialog = true;
        },

        save() {
            this.disabled = true;
            if (this.mode === 1) {
                Category.post(this.category)
                    .then(() => {
                        this.getCategories();
                        this.selectedCategory = [];
                        this.dialog = false;
                        this.disabled = false;
                    })
                    .catch(err => {
                        this.errorMessage = err.response.data;
                        setTimeout(() => (this.errorMessage = ""), 5000);
                        this.disabled = false;
                    });
            } else {
                Category.put(this.category)
                    .then(() => {
                        this.getCategories();
                        this.selectedCategory = [];
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
            this.dialog = false;
            confirm("Are you sure you want to delete this category?") &&
                Category.delete(id)
                    .then(() => this.getCategories())
                    .catch(err => {
                        this.errorMessage = err.response.data;
                        this.snackbar = true;
                        setTimeout(() => {
                            this.snackbar = false;
                            this.errorMessage = "";
                        }, 5000);
                    });
        }
    },

    watch: {
        selectedCategory(val) {
            if (val.length > 1) val = val.splice(0, 1);
            this.category.parent = val[0];
        }
    },

    created() {
        this.getCategories();
    }
};
</script>
