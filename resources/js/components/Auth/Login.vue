<template>
    <div class="login-page">
        <b-notification v-if="allError"
                        type="is-danger"
                        has-icon
                        aria-close-label="Close notification">
            {{ allError }}
        </b-notification>
        <b-notification v-if="error"
                        type="is-warning is-light"
                        has-icon
                        aria-close-label="Close notification">
            {{ error }}
        </b-notification>
        <h1>Login </h1>
        <form @keydown.enter="submitForm">
            <b-field label="Email">
                <b-input v-model="user.email" type="email" required></b-input>
            </b-field>
            <b-field label="Password">
                <b-input  password-reveal v-model="user.password" type="password" required></b-input>
            </b-field>
            <div class="login-btn">
                <b-button type="submit" class="mt-5" variant="is-primary" @click="submitForm">Login</b-button>
            </div>
        </form>

    </div>
</template>

<script>
import axios from "../../axios-instance";

export default {
    name: "Login",

    data() {
        return {
            user: {
                email: "",
                password: "",
            },
            error: null,
            allError: null
        };
    },
    methods: {
        submitForm() {
            if ( this.user.email && this.user.password ) {
                axios.post('login', this.user)
                    .then((res) => {
                        localStorage.setItem('authToken', res.data.payload.token);
                        window.dispatchEvent(new CustomEvent('authToken-localstorage-changed', {
                            detail: {
                                storage: localStorage.getItem('authToken')
                            }
                        }));
                        this.$router.push('/')
                    })
                    .catch(error => {
                        this.error = error.response.data.error.message;
                    })
            } else {
                this.allError = 'All fields are required'
            }
        }
    }
}
</script>

<style>
.login-page {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.media {
    display: flex;
    align-items: center;
    justify-content: center;
}

.notification {
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}
.field >span{
    color: red;
}

.field > label {
    margin-top: 10px;
}
.login-btn {
    display:flex;
}
</style>
