<template>
    <div class="container update-password">
        <section class="wrapper">
            <div class="content">
                <p class="mb-5">Profile Information</p>
                Update Your Profile Information And Mail
            </div>
            <div class="inputs">
                <span style="align-self: flex-start">Name</span>
                <b-input type="text" v-model="user.name"></b-input>
                <span>Email</span>
                <b-input type="email" v-model="user.email"></b-input>
                <b-button @click.prevent="updateUser" class="mt-3" type="is-primary" outlined>Update</b-button>
            </div>

        </section>
        <hr>
    </div>
</template>

<script>
import axios from '../../axios-instance'

export default {
    name: "UpdateProfile",
    props:[
        'user',
    ],
    data (){
        return {

        }
    },
    methods: {
        updateUser() {
            axios.put('user/update/profile',this.user)
                .then((res) => {
                this.user = res.data.payload
                console.log(this.user)
            })
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
