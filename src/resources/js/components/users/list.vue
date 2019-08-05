<template>
    <div class="row">
        <div class="col-12 mb-2">
            <button type="button" class="btn btn-primary float-right" @click="onCreate">Create User</button>
        </div>
        <div class="col-12">
            <loading v-if="loading" />
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <user-row v-for="user in users" :key="user.id" :user="user" />
                </tbody>
            </table>
        </div>
        <create-user-form v-if="visible" @close="onClose" />
    </div>
</template>

<script>
import UserRow from "./row";
import CreateUserForm from "./create";
import Loading from "@/components/theme/loading";
import { mapGetters, mapActions } from "vuex";
export default {
    components: {
        Loading,
        UserRow,
        CreateUserForm
    },
    data: () => ({
        loading: true,
        visible: false
    }),
    computed: {
        ...mapGetters("users", ["users"])
    },
    created() {
        this.all()
            .then(() => {})
            .catch(error => console.log(error))
            .then(() => (this.loading = false));
    },
    beforeDestroy() {
        this.clear();
    },
    methods: {
        ...mapActions("users", ["all", "clear"]),
        onCreate() {
            this.visible = true;
        },
        onClose() {
            this.visible = false;
        }
    }
};
</script>
