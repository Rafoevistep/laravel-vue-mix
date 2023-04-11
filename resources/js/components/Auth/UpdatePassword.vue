<template>
    <div class="container update-password">
        <section class="wrapper">
            <div class="content">
                <p class="mb-5">Update Password</p>
                Ensure your account is using long , random to stay secure
            </div>
            <div class="inputs">
                <span style="align-self: flex-start">Old Password</span>
                <b-input password-reveal v-model="user.password" type="password" required></b-input>
                <span>New Password</span>
                <b-input password-reveal v-model="new_password" type="password" required  minlength="8"></b-input>
                <span>Confirm Password</span>
                <b-input password-reveal v-model="confirm_password" type="password" required minlength="8" ></b-input>
                <h6>{{error}}</h6>
                <b-button @click.prevent="updatePassword" class="mt-3" type="is-primary" outlined>Update</b-button>
            </div>
        </section>
        <hr>
    </div>
</template>

<script>
import axios from '../../axios-instance'

export default {
    name: "UpdateProfile",
    props: [
        'user',
    ],
    data() {
        return {
            new_password:'',
            confirm_password: '',
            error:null
        }
    },
    methods: {
        updatePassword() {
            this.error = ''
            if(this.new_password === this.confirm_password) {
                if (this.new_password.length >= 8) {

                this.user.new_password = this.new_password
                this.user.confirm_password = this.confirm_password
                axios.put('user/update/password', this.user)
                    .then(res => {
                        this.user = res.data.payload
                        this.confirm_password = ''
                        this.new_password = ''
                    }).catch(({response}, error) => {
                    console.log(response.data.error.message)
                    this.error = response.data.error.message ? response.data.error.message : response.data.errors.new_password[0]
                    console.log(error)
                })
            } else {
                    this.error = 'Passwords must be at least 8 characters long'
                }
            }else{
                this.error = 'New Password and Confirm Password Not Match'
                this.confirm_password = ''
            }
        },
    }
}
</script>

<style scoped>
.inputs {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

.inputs > span {
    align-self: flex-start;
    margin-bottom: 5px;
    margin-top: 5px;
}

.inputs > h6 {
    margin-top: 3px;
    color:red;
    width: 255px;
}

.update-password {
    margin-top: 50px;
}

.wrapper {
    display: flex;
    flex-wrap: wrap;
}

.content {
    width: 50%;
}
</style>
