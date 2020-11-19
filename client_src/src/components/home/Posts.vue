<template>
    <section class="mt-12">
        <v-container fluid class="pa-0">
            <v-row no-gutters>
                <v-col v-for="post in posts" :key="post.id" cols="4">
                    <v-card :color="post.color" flat tile class="pb-12">
                        <v-card-text
                            v-text="post.date"
                            class="black--text"
                        ></v-card-text>

                        <v-card-title
                            v-text="post.title"
                            style="word-break: normal; font-weight: 800"
                            class="primary--text"
                        ></v-card-title>

                        <v-card-text v-text="post.text"></v-card-text>

                        <v-card-actions>
                            <v-btn color="primary" tile small class="ml-2"
                                >read more</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </section>
</template>

<script>
export default {
    name: "Posts",

    data: () => ({
        posts: [
            {
                id: 1,
                title: "Post Format: Quote, Lorem Ipsum Is Simply Text",
                text: `Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Placeat voluptatum harum impedit.`,
                date: "Jan 04, 2017",
                color: "blue-grey lighten-4"
            },
            {
                id: 2,
                title: "Post Format: Quote, Lorem Ipsum Is Simply Text",
                text: `Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Placeat voluptatum harum impedit.`,
                date: "Jan 04, 2017",
                color: "grey lighten-3"
            },
            {
                id: 3,
                title: "Post Format: Quote, Lorem Ipsum Is Simply Text",
                text: `Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Placeat voluptatum harum impedit.`,
                date: "Jan 04, 2017",
                color: "blue-grey lighten-4"
            }
        ]
    })
};
</script>
