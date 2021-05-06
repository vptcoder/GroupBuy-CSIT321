/// [VPT] 20210404: Update Admin page
import Vue from "vue";
import VueRouter from "vue-router";
import Vuex from "vuex";

/// [VPT] 20210404: Overide VueRouter push function to ignore routing error in console.
const originalPush = VueRouter.prototype.push;
VueRouter.prototype.push = function push(location) {
    return originalPush.call(this, location).catch(err => err);
};

Vue.use(VueRouter);
Vue.use(Vuex);

import App from "./views/App.vue";
import Home from "./views/Home.vue";
import Login from "./views/Login.vue";
import Register from "./views/Register.vue";
import SingleProduct from "./views/SingleProduct.vue";
import Checkout from "./views/Checkout.vue";
import Confirmation from "./views/Confirmation.vue";
import UserBoard from "./views/UserBoard.vue";
import Admin from "./views/Admin.vue";
import Watchlist from "./views/Watchlist.vue";
import Notifications from "./views/Notifications.vue";
import ViewOwnAccount from "./views/ViewOwnAccount.vue";
import JoinGroupBuy from "./views/JoinGroupBuy.vue";

import { isArguments } from "lodash";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/watchlist",
            name: "watchlist",
            component: Watchlist
        },
        {
            path: "/notifications",
            name: "notifications",
            component: Notifications
        },
        {
            path: "/viewownaccount",
            name: "viewownaccount",
            component: ViewOwnAccount
        },
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/register",
            name: "register",
            component: Register
        },
        {
            path: "/products/:id",
            name: "single-products",
            component: SingleProduct
        },
        {
            path: "/join",
            name: "join",
            component: JoinGroupBuy,
            props: route => ({ pid: route.query.pid })
        },
        {
            path: "/confirmation",
            name: "confirmation",
            component: Confirmation
        },
        {
            path: "/checkout",
            name: "checkout",
            component: Checkout,
            props: route => ({ pid: route.query.pid })
        },
        {
            path: "/dashboard",
            name: "userboard",
            component: UserBoard,
            meta: {
                requiresAuth: true,
                is_user: true
            }
        },
        {
            path: "/admin/:page",
            name: "admin-pages",
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin,
            meta: {
                requiresAuth: true,
                is_admin: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    console.log(to.path);
    if(to.path.includes("/admin")){
        console.log("router-beforeEach: is admin - " + to.path);
        store.commit("HIDENAV");
    } else {
        console.log("router-beforeEach: is not admin - " + to.path);
        store.commit("SHOWNAV");
    }

    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (localStorage.getItem("bigStore.jwt") == null) {
            next({
                path: "/login",
                params: { nextUrl: to.fullPath }
            });
        } else {
            let user = JSON.parse(localStorage.getItem("bigStore.user"));
            if (to.matched.some(record => record.meta.is_admin)) {
                if (user.is_admin == 1) {
                    next();
                } else {
                    next({ name: "userboard" });
                }
            } else if (to.matched.some(record => record.meta.is_user)) {
                if (user.is_admin == 0) {
                    next();
                } else {
                    next({ name: "admin" });
                }
            }
            next();
        }
    } else {
        next();
    }
});

const state = {
    navigation: {
        show: true
    }
};

// // This is look like events.
const mutations = {
    SHOWNAV(state) {
        state.navigation.show = true;
    },
    HIDENAV(state) {
        state.navigation.show = false;
    }
};

// This is store!!!.
const store = new Vuex.Store({
    state,
    mutations
});

const app = new Vue({
    store,
    el: "#app",
    components: { App },
    router,
    watch: {
        /// [VPT] 20210404: Reference, actual code moved to router.beforeEach
        // $route: function() {
        //     if (this.$route.path.includes("/admin")) {
        //         console.log("Page-check: is admin - " + this.$route.path);
        //         store.commit("HIDENAV");
        //     } else {
        //         console.log("Page-check: is not admin - " + this.$route.path);
        //         store.commit("SHOWNAV");
        //     }
        // }
    },
});
