<template>
    <v-container style="height: 100%">
        <v-row class="fill-height" justify="center" align="center">
            <v-card outlined width="500" tile>
                <v-col class="primary py-5">
                    <router-link to="/">
                        <v-img
                            src="../assets/footer-logo.png"
                            width="100"
                            style="margin: auto"
                        ></v-img>
                    </router-link>
                </v-col>

                <v-card-title>
                    <v-col class="text-center">
                        Sign In to UpStar
                    </v-col>
                </v-card-title>

                <v-form v-model="valid" class="px-5" @submit.prevent="SignIn">
                    <v-text-field
                        v-model="email"
                        type="email"
                        label="Email"
                        outlined
                        clearable
                        :rules="emailRules"
                        :success="emailSuccess"
                    ></v-text-field>

                    <v-text-field
                        v-model="password"
                        ref="password"
                        :type="showPassword ? 'text' : 'password'"
                        class="mt-1"
                        label="Password"
                        outlined
                        clearable
                        append-icon="mdi-eye"
                        :rules="passwordRules"
                        :success="passwordSuccess"
                        @click:append="showPassword = !showPassword"
                    >
                    </v-text-field>

                    <v-alert v-if="serverError" type="error">{{
                        serverError
                    }}</v-alert>

                    <v-card-actions class="px-0">
                        Don't have an account?
                        <router-link to="/register" class="blue--text mx-1"
                            >Create one</router-link
                        >
                        here.
                        <v-spacer></v-spacer>
                        <v-btn
                            type="submit"
                            color="primary"
                            tile
                            :disabled="disabled"
                            >sign in</v-btn
                        >
                    </v-card-actions>
                </v-form>
            </v-card>
        </v-row>
    </v-container>
</template>

<script>
import { mapMutations } from "vuex";

export default {
    beforeRouteEnter(to, from, next) {
        next(vm => {
            setTimeout(() => {
                if (vm.$store.state.auth.user._id) {
                    vm.$router.push("/");
                }
            }, 300);
        });
    },

    data() {
        return {
            serverError: "",
            valid: false,
            disabled: true,
            showPassword: false,
            email: "",
            emailSuccess: false,
            password: "",
            passwordSuccess: false,
            emailRules: [
                v => {
                    if (v) {
                        this.emailSuccess = true;
                        return true;
                    } else {
                        return "E-mail is required";
                    }
                },
                v => /.+@.+/.test(v) || "E-mail must be valid"
            ],
            passwordRules: [
                v => {
                    if (v) {
                        this.passwordSuccess = true;
                        return true;
                    } else {
                        return "Password is required";
                    }
                },
                v =>
                    (v || "").length >= 5 ||
                    "Password must be at least 5 characters long"
            ]
        };
    },

    methods: {
        ...mapMutations(["setToken", "setUser"]),

        SignIn() {
            this.disabled = true;
            this.$axios
                .post("http://127.0.0.1:8000/api/login", {
                    email: this.email,
                    password: this.password
                })
                .then(res => {
                    localStorage.setItem("token", res.data.access_token);

                    this.setToken(res.data.access_token);
                    this.setUser(res.data.user);

                    this.$router.replace("/");
                })
                .catch(err => {
                    this.serverError = err.response.data;
                    setTimeout(() => (this.serverError = ""), 5000);
                    this.disabled = false;
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
        }
    }
};
</script>
