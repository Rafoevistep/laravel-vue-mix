<template>
    <div>
        <b-button label="Delete Account" type="is-danger" size="is-small" @click="confirmCustomDelete" />
    </div>
</template>

<script>

import axios from '../../axios-instance';


export default {
    name: "DeleteAccount",
    methods: {
        confirm() {
            this.$buefy.dialog.confirm({
                message: 'Continue on this task?',
                onConfirm: () => this.$buefy.toast.open('User confirmed')
            })
        },
        confirmCustom() {
            this.$buefy.dialog.confirm({
                cancelText: 'Disagree',
                confirmText: 'Agree',
                type: 'is-success',
                onConfirm: () => this.$buefy.toast.open('User agreed')
            })
        },
        confirmCustomDelete() {
            this.$buefy.dialog.confirm({
                title: 'Deleting account',
                message: 'Are you sure you want to <b>delete</b> your account? This action cannot be undone.',
                confirmText: 'Delete Account',
                type: 'is-danger',
                hasIcon: true,

                onConfirm: () => {
                    axios.delete('user/delete/account')
                        .then((res) => {
                            localStorage.removeItem('authToken');
                            this.$router.push("/");
                            window.dispatchEvent(new CustomEvent('authToken-localstorage-changed', {
                                detail: {
                                    storage: null
                                }
                            }))
                        })
                    this.$buefy.toast.open('Account deleted!')
                },
            })

        },
    }
}
</script>

<style scoped></style>
