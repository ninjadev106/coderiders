<template>
    <v-app>
        <router-view name="header"></router-view>

        <v-main>
            <router-view></router-view>
        </v-main>

        <router-view name="footer"></router-view>
    </v-app>
</template>

<script>
import { mapMutations } from "vuex";

export default {
    name: "App",
    data: () => ({}),

    methods: {
        ...mapMutations(["setToken", "setUser"]),

        getUser(token) {
            this.$axios
                .get("http://127.0.0.1:8000/api/me", {
                    headers: {
                        "Authorization": `Bearer ${token}`
                    }
                })
                .then(res => this.setUser(res.data))
                .catch(err => console.error(err.response.data));
        },

        initialize() {
            const token = localStorage.getItem("token");

            if (token) {
                this.setToken(token);
                this.getUser(token);
            }
        }
    },

    created() {
        this.initialize();
    }
};
</script>

<style lang="scss">
  @import "assets/scss/index.scss";

.bb {
    border: 1px solid black;
}

.bw {
    border: 1px solid white;
}

.b-tile {
    border-radius: 0 !important;
}

.pointer {
    cursor: pointer;
}
</style>
