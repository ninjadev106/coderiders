import Vue from "vue";
import VueRouter from "vue-router";
import header from "../components/AppHeader";
import footer from "../components/AppFooter";

Vue.use(VueRouter);

const routes = [
    {
        path: "/",
        name: "Home",
        components: {
            header,
            default: () =>
                import(/* webpackChunkName: "home" */ "../views/Home.vue"),
            footer
        }
    },
    {
        path: "/signin",
        name: "SignIn",
        component: () =>
            import(/* webpackChunkName: "signIn" */ "../views/SignIn.vue")
    },
    {
        path: "/register",
        name: "Register",
        component: () =>
            import(/* webpackChunkName: "register" */ "../views/Register.vue")
    },
    {
        path: "/shop",
        name: "Shop",
        components: {
            header,
            default: () =>
                import(/* webpackChunkName: "shop" */ "../views/Shop.vue"),
            footer
        }
    },
    {
        path: "/blog",
        name: "Blog",
        components: {
            header,
            default: () =>
                import(/* webpackChunkName: "blog" */ "../views/Blog.vue"),
            footer
        }
    },
    {
        path: "/about",
        name: "About",
        components: {
            header,
            default: () =>
                import(/* webpackChunkName: "about" */ "../views/About.vue"),
            footer
        }
    },
    {
        path: "/contact",
        name: "Contact",
        components: {
            header,
            default: () =>
                import(
                    /* webpackChunkName: "contact" */ "../views/Contact.vue"
                ),
            footer
        }
    },

    {
        path: "/admin",
        name: "Admin",
        components: {
            header: () =>
                import(
                    /* webpackChunkName: "adminHeader" */ "../components/admin/Header.vue"
                ),
            default: () =>
                import(
                    /* webpackChunkName: "admin" */ "../views/admin/Admin.vue"
                )
        },
        children: [
            {
                path: "users",
                name: "AdminUsers",
                component: () =>
                    import(
                        /* webpackChunkName: "adminUsers" */ "../views/admin/Users.vue"
                    )
            },
            {
                path: "categories",
                name: "AdminCategories",
                component: () =>
                    import(
                        /* webpackChunkName: "adminCategories" */ "../views/admin/Categories.vue"
                    )
            },
            {
                path: "products",
                name: "AdminProducts",
                component: () =>
                    import(
                        /* webpackChunkName: "adminProducts" */ "../views/admin/Products.vue"
                    )
            }
        ]
    }
];

const router = new VueRouter({
    mode: "history",
    base: process.env.BASE_URL,
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition;
        } else {
            return { x: 0, y: 0 };
        }
    }
});

export default router;
