<template>
    <v-card tile outlined>
        <v-toolbar flat>
            <v-toolbar-title>Collections</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn outlined color="teal darken-4" class="mr-5" @click="open(1)"
                >new collection</v-btn
            >
        </v-toolbar>

        <v-data-table
            :headers="headers"
            :items="collections"
            disable-sort
            class="border-top"
        >
            <template v-slot:item.image="{ item }">
                <v-img
                    :src="'http://localhost:3000/' + item.image"
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
            <v-card>
                <v-card-title>{{ title }}</v-card-title>

                <v-container>
                    <v-row no-gutters justify="space-around">
                        <v-col cols="5">
                            <v-text-field
                                v-model="collection.name"
                                class="b-tile"
                                label="name"
                                color="teal darken-4"
                                outlined
                                dense
                                clearable
                            ></v-text-field>
                        </v-col>

                        <v-col cols="5">
                            <v-file-input
                                class="b-tile"
                                label="upload a photo"
                                color="teal darken-4"
                                dense
                                outlined
                                @change="onFileSelected"
                            ></v-file-input>
                        </v-col>

                        <v-col cols="5">
                            <v-select
                                v-model="collection.category"
                                :items="categories"
                                return-object
                                menu-props="offsetY"
                                class="b-tile"
                                label="category"
                                color="teal darken-4"
                                item-color="teal darken-4"
                                outlined
                                dense
                                clearable
                                open-on-clear
                            ></v-select>

                            <v-textarea
                                v-model="collection.description"
                                class="b-tile"
                                label="description"
                                color="teal darken-4"
                                outlined
                                clearable
                            ></v-textarea>
                        </v-col>

                        <v-col cols="5" class="pa-0">
                            <v-card tile outlined height="86%">
                                <v-img
                                    v-if="collection.image"
                                    :src="collection.image"
                                    height="100%"
                                    contain
                                ></v-img>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-container>

                {{ errorMessage }}
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn text @click="dialog = false">cancel</v-btn>
                    <v-btn color="teal darken-4" dark width="90" @click="save"
                        >save</v-btn
                    >
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-card>
</template>

<script>
// import Collection from "../../models/Collection";

export default {
    name: "Collections",
    data: () => ({
        headers: [
            { text: "Code", value: "code" },
            { text: "Category", value: "category" },
            { text: "Name", value: "name" },
            { text: "Description", value: "description" },
            { text: "Image", value: "image" },
            { text: "Actions", value: "action" }
        ],
        collections: [],
        // collection: new Collection(),
        categories: [
            { text: "Workwear", value: "Workwear", code: "1" },
            { text: "Medical", value: "Medical", code: "2" }
        ],
        dialog: false,
        image: "",
        mode: 0,
        errorMessage: ""
    }),

    computed: {
        title() {
            return this.mode === 1 ? "New Collection" : "Update Collection";
        }
    },

    methods: {
        getCollections() {
            // Collection.get()
            //     .then(res => (this.collections = res.data))
            //     .catch(err => console.error(err.response.data));
        },

        getTextileTypes() {
            this.$axios
                .get(`http://127.0.0.1:8000/api/textileTypes`)
                .then(res => (this.textileTypes = res.data))
                .catch(err => console.error(err.response.data));
        },

        open(mode, item) {
            // this.collection = new Collection(item);
            if (item)
                this.collection.image =
                    "http://localhost:3000/" + this.collection.image;
            this.mode = mode;
            this.dialog = true;
        },

        save() {
            this.collection.code =
                this.collections.filter(col => {
                    return col.category === this.collection.category.value;
                }).length + 1;

            if (this.mode === 1) {
                // Collection.post(this.collection)
                //     .then(res => {
                //         this.collections.push(res.data);
                //         this.dialog = false;
                //     })
                //     .catch(err => console.error(err.response.data));
            } else {
                // Collection.put(this.collection, this.categories)
                //     .then(res => {
                //         let index = this.collections.findIndex(
                //             col => col._id === res.data._id
                //         );
                //         this.collections.splice(index, 1, res.data);
                //         this.dialog = false;
                //     })
                //     .catch(err => (this.errorMessage = err.response.data));
            }
        },

        remove() {
            // Collection.delete(id)
            //     .then(res => {
            //         let index = this.collections.findIndex(
            //             collection => collection._id === res.data._id
            //         );
            //         this.collections.splice(index, 1);
            //     })
            //     .catch(err => console.error(err.response.data));
        },

        onFileSelected(event) {
            this.collection.imageFile = event;
            const reader = new FileReader();
            reader.readAsDataURL(this.collection.imageFile);
            reader.onload = e => (this.collection.image = e.target.result);
        }
    },

    created() {
        this.getCollections();
    }
};
</script>
