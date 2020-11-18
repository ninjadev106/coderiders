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
                        Create an account
                    </v-col>
                </v-card-title>

                <v-form v-model="valid" class="px-5" @submit.prevent="register">
                    <v-text-field
                        v-model="username"
                        type="email"
                        label="Username"
                        outlined
                        clearable
                        :rules="usernameRules"
                        :success="usernameSuccess"
                    ></v-text-field>

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

                    <v-text-field
                        v-model="confirmPassword"
                        ref="confirmPassword"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        class="mt-1"
                        label="Confirm Password"
                        outlined
                        clearable
                        append-icon="mdi-eye"
                        :rules="confirmPasswordRules"
                        :success="confirmPasswordSuccess"
                        @click:append="
                            showConfirmPassword = !showConfirmPassword
                        "
                    ></v-text-field>

                    <v-alert v-if="serverError" type="error">{{
                        serverError
                    }}</v-alert>

                    <v-card-actions class="px-0">
                        Already have an account?
                        <router-link to="/signin" class="blue--text mx-1"
                            >Sign In</router-link
                        >
                        here.
                        <v-spacer></v-spacer>
                        <v-btn
                            type="submit"
                            color="primary"
                            tile
                            :disabled="disabled"
                            @click="register"
                            >register</v-btn
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
                if (vm.$store.state.auth.user.id) {
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
            showConfirmPassword: false,
            username: "",
            usernameSuccess: false,
            email: "",
            emailSuccess: false,
            password: "",
            passwordSuccess: false,
            confirmPassword: "",
            confirmPasswordSuccess: false,
            usernameRules: [
                v => {
                    if (v) {
                        this.usernameSuccess = true;
                        return true;
                    } else {
                        return "Name is required";
                    }
                },
                v =>
                    (v || "").length >= 3 ||
                    "Username must be at least 3 characters long",
                v =>
                    (v || "").length <= 10 ||
                    "Username must be less than 10 characters"
            ],
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
            ],
            confirmPasswordRules: [
                v => {
                    if (v) {
                        this.confirmPasswordSuccess = true;
                        return true;
                    } else {
                        return "Must match password";
                    }
                },
                v => v === this.password || "Must match password"
            ]
        };
    },

    methods: {
        ...mapMutations(["setToken", "setUser"]),

        register() {
            this.disabled = true;
            this.$axios
                .post(
                    "http://127.0.0.1:8000/api/register",
                    {
                        username: this.username,
                        email: this.email,
                        password: this.password
                    }
                )
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
    },

    mounted() {}
};
</script>
