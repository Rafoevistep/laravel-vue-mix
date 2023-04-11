<template>
    <b-navbar class="mt-5">
        <template #brand>
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                <img
                    src="https://raw.githubusercontent.com/buefy/buefy/dev/static/img/buefy-logo.png"
                    alt="Lightweight UI components for Vue.js based on Bulma"
                >
            </b-navbar-item>
        </template>
        <template #start>
            <b-navbar-item tag="router-link" :to="{ path: '/' }">
                Home
            </b-navbar-item>
            <b-dropdown :triggers="['hover']" aria-role="list">
                <template #trigger>
                    <b-button
                        class="dropdown-categories"
                        label="Categories"
                    />
                </template>
                <b-dropdown-item aria-role="listitem">Action</b-dropdown-item>
                <b-dropdown-item aria-role="listitem">Another action</b-dropdown-item>
                <b-dropdown-item aria-role="listitem">Something else</b-dropdown-item>
            </b-dropdown>
            <b-navbar-dropdown  label="Info">
                <b-navbar-item href="#">
                    About
                </b-navbar-item>
                <b-navbar-item href="#">
                    Contact
                </b-navbar-item>
            </b-navbar-dropdown>
        </template>

        <template #end>
            <b-dropdown v-if="authToken" aria-role="list" class="user">
                <template #trigger="{ active }">
                    <b-button class="user-btn">
                        <font-awesome-icon icon="fa-solid fa-user"/>
                        {{ user.name }}
                    </b-button>
                </template>
                <b-dropdown-item aria-role="listitem" tag="router-link">
                    <router-link to="/user-profile">
                    User Profile
                    <font-awesome-icon icon="fa-solid fa-address-card"/>
                    </router-link>
                </b-dropdown-item>
                <b-dropdown-item @click="logout">
                    Log Out
                    <font-awesome-icon icon="fa-solid fa-arrow-right-from-bracket"/>
                </b-dropdown-item>
            </b-dropdown>

            <b-navbar-item v-if="!authToken" tag="div">
                <div class="buttons">
                    <b-navbar-item class="button is-primary" tag="router-link" :to="{ path: '/sign-up' }">
                        <strong>Sign up</strong>
                    </b-navbar-item>
                    <b-navbar-item tag="router-link" :to="{ path: '/login' }">
                        Log in
                    </b-navbar-item>
                </div>
            </b-navbar-item>
        </template>
    </b-navbar>
</template>

<script>

import axios from "../axios-instance";

export default {

    name: "Navbar",

    data() {
        return {
            user: {},
            authToken: localStorage.getItem('authToken') || null,
        }
    },
    watch: {
        authToken(val, oldVal) {
            // if(val){
            //     this.loadAuthUser();
            // }
        },

    },
    mounted() {
        window.addEventListener('authToken-localstorage-changed', (event) => {
            this.authToken = event.detail.storage;
        });
        this.loadAuthUser();
    },
    methods: {
        loadAuthUser() {
            axios.get('user-detail')
                .then((res) => {
                this.user = res.data.payload
            })
        },
        logout() {
            this.axios.get('/logout').then(result => {
                localStorage.removeItem('authToken');
                window.dispatchEvent(new CustomEvent('authToken-localstorage-changed', {
                    detail: {
                        storage: null
                    }
                }));
                this.$router.push("/");
            }).catch(error => {
                return error
            })
        },
    }

}
</script>

<style>
.user span {
    display: flex;
    align-items: center;
}

.user svg {
    margin-right: 10px;
    color: #8e71dc;
}

.user-btn {
    border-radius: 20px;
}

.dropdown-categories{
    border: none;
    height: 55px;
}

</style>
