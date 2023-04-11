<template>
    <div class="signup-page">
        <b-notification v-if="allError"
                        type="is-danger"
                        has-icon
                        aria-close-label="Close notification">
            {{ allError }}
        </b-notification>
        <h1>Sign Up</h1>
        <form @keydown.enter="submitForm">
        <ValidationProvider rules="secret" v-slot="{ errors }">
            <b-field label="Name">
                <b-input v-model="user.name" required min="4"></b-input>
                <span v-if="error" >{{ error.name[0] }}</span>
            </b-field>
        </ValidationProvider>

        <ValidationProvider rules="secret" v-slot="{ errors }">
            <b-field label="Email">
                <b-input v-model="user.email" type="email" required></b-input>
                <span v-if="error">{{ error.email[0] }}</span>
            </b-field>
        </ValidationProvider>

        <ValidationProvider rules="secret" v-slot="{ errors }">
            <b-field label="Password">
                <b-input v-model="user.password" password-reveal type="password" required></b-input>
                <span v-if="error">{{ error.password[0] }}</span>
            </b-field>
        </ValidationProvider>

        <ValidationProvider rules="secret" v-slot="{ errors }">
            <b-field label="Confirm Password">
                <b-input v-model="user.confirm_password" password-reveal type="password" required></b-input>
                <span v-if="error">{{ error.confirm_password[0] }}</span>
            </b-field>
        </ValidationProvider>

        <b-button type="submit" class="mt-5" variant="is-primary" @click="submitForm">Sign Up</b-button>
        </form>
    </div>
</template>

<script>
import axios from "../../axios-instance";

export default {
    name: "SignUp",

    data() {
        return {
            user: {
                name: "",
                email: "",
                password: "",
                confirm_password: ""
            },
            error: null,
            allError: null
        };
    },
    methods: {
        submitForm() {
            if (this.user.name && this.user.email && this.user.password && this.user.confirm_password) {
                axios.post('register', this.user)
                    .then((res) => {
                        this.$router.push('/login')
                    })
                    .catch(({response}) => {
                        this.error = response.data.errors;
                    })
            } else {
                this.allError = 'All fields is required'
            }
        }
    }
}
</script>

<style>
.signup-page {
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

</style>
