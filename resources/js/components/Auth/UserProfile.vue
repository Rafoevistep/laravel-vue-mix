<template>
 <div class="container mt-5 mb-5">
     <p>
          Welcome ! {{authUser.name}}
     </p>
     <section>
         <div class="buttons mt-4">
             <b-button
                 label="View profile information data"
                 type="is-primary"
                 size="is-small"
                 @click="isCardModalActive = true" />
         </div>
         <b-modal v-model="isCardModalActive" :width="640" scroll="keep">
             <div class="card">
                 <div class="card-content">
                     <div class="media">
                         <div class="media-left">
<!--                             <figure class="image is-48x48">-->
<!--                                 <img src="/static/img/placeholder-1280x960.png" alt="Image">-->
<!--                             </figure>-->
                         </div>
                         <div class="media-content">
                             <p class="title is-4">{{authUser.name}}</p>
                             <p class="subtitle is-6">{{authUser.email}}</p>
                         </div>
                     </div>
                     <br>
                     <div class="content">
                        <p>Your Accunt Crated {{authUser.created_at | moment}}</p>
                     </div>
                 </div>
             </div>
         </b-modal>
     </section>
     <update-profile :user="authUser"/>
     <update-password :user="authUser" />
     <delete-account />
 </div>
</template>

<script>
import UpdateProfile from "./UpdateProfile";
import UpdatePassword from "./UpdatePassword";
import DeleteAccount from "./DeleteAccount";
import moment from "moment";
import axios from "../../axios-instance";

export default {
    name: "UserProfile",
    components: {
        UpdateProfile,
        UpdatePassword,
        DeleteAccount
    },
    data(){
        return{
            authUser: {},
            isCardModalActive: false,
        }
    },
    mounted(){
        this.loadAuthUser();
    },
    methods: {
        loadAuthUser() {
            axios.get('user-detail').then((res) => {
                this.authUser = res.data.payload
            })
        }
    },
    filters: {
        moment: function (date) {
            return moment(date).format('MMMM Do YYYY, h:mm:ss a');
        }
    }
}
</script>

<style scoped>

</style>
