<template>
    <header>
        <v-app-bar app flat dense color="primary" dark>
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>
                <router-link to="/">
                    <v-img
                        src="../../assets/footer-logo.png"
                        width="120"
                    ></v-img>
                </router-link>
            </v-toolbar-title>

            <v-divider vertical inset class="mx-5"></v-divider>

            <v-toolbar-title>
                Admin Panel
            </v-toolbar-title>
        </v-app-bar>

        <v-navigation-drawer app temporary v-model="drawer">
            <v-app-bar flat dense color="primary" dark>
                <v-app-bar-nav-icon
                    @click="drawer = !drawer"
                ></v-app-bar-nav-icon>
                <v-toolbar-title>
                    <router-link to="/">
                        <v-img
                            src="../../assets/footer-logo.png"
                            width="120"
                        ></v-img>
                    </router-link>
                </v-toolbar-title>
            </v-app-bar>

            <v-list>
                <v-list-item-group color="primary">
                    <v-list-item
                        v-for="item in items"
                        :key="item.text"
                        :to="item.to"
                    >
                        <v-list-item-action>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-action>
                        <v-list-item-title v-text="item.text">
                        </v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </header>
</template>

<script>
export default {
    name: "AdminHeader",

    data: () => ({
        drawer: false,
        items: [
            {
                text: "Users",
                to: "/admin/users",
                icon: "mdi-account-group-outline"
            },
            {
                text: "Categories",
                to: "/admin/categories",
                icon: "mdi-shape-outline"
            },
            {
                text: "Products",
                to: "/admin/products",
                icon: "mdi-alpha-p-circle-outline"
            }
        ]
    })
};
</script>
