import vueRouter from 'vue-router';
import Vue from 'vue';

Vue.use(vueRouter);

import Index from "./components/Index";
import Login from  "./components/Auth/Login";
import SignUp from "./components/Auth/SignUp";
import UserProfile from "./components/Auth/UserProfile";

const routes = [
    {
        path: "/",
        name: 'Index',
        component: Index
    },
    {
        path: '/login',
        component: Login,
        beforeEnter: (to, from, next) => {
            // check if user is authenticated
            if (localStorage.getItem('authToken')) {
              // user is authenticated, redirect to login
              next('/')
            } else {
              // user is not authenticated, allow access to route
              next()
            }
        }
    },
    {
        path: '/sign-up',
        component: SignUp,
        beforeEnter: (to, from, next) => {
            // check if user is authenticated
            if (localStorage.getItem('authToken')) {
              // user is authenticated, redirect to login
              next('/')
            } else {
              // user is not authenticated, allow access to route
              next()
            }
        }
    },
    {
        path: '/user-profile',
        component: UserProfile
    }
]


export default new vueRouter({
    mode: "history",
    routes
});
