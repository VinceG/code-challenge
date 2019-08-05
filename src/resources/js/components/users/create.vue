<template>
    <modal title="Create User" visible @close="onClose">
        <div v-if="error" class="row">
            <div class="col-12">
                <div class="alert alert-danger" v-html="error" />
            </div>
        </div>
        <form @submit.prevent>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input v-model="email" type="email" class="form-control" id="email" />
                <div v-if="$v.email.$error" class="text-danger">Email address is required.</div>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input v-model="first_name" type="text" class="form-control" id="first_name" />
                <div v-if="$v.first_name.$error" class="text-danger">First Name is required.</div>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input v-model="last_name" type="text" class="form-control" id="last_name" />
                <div v-if="$v.last_name.$error" class="text-danger">Last Name is required.</div>
            </div>
        </form>
        <template #footer>
            <button
                type="button"
                class="btn btn-primary"
                :disabled="loading"
                @keyup.enter="onSubmit"
                @click="onSubmit"
            >Submit</button>
        </template>
    </modal>
</template>

<script>
import Modal from "@/components/theme/modal";
import { validationMixin } from "vuelidate";
import { get, isEmpty, isArray, join } from "@/utils/lodash";
import { mapActions } from 'vuex';
const { required, email, minLength } = require("vuelidate/lib/validators");
export default {
    mixins: [validationMixin],
    components: {
        Modal
    },
    data: () => ({
        loading: false,
        error: null,
        email: null,
        first_name: null,
        last_name: null
    }),
    validations: {
        email: {
            required,
            email
        },
        first_name: {
            required,
            minLength: minLength(3)
        },
        last_name: {
            required,
            minLength: minLength(3)
        }
    },
    computed: {
        fields() {
            return {
                email: this.email,
                first_name: this.first_name,
                last_name: this.last_name
            }
        }
    },
    methods: {
        ...mapActions('users', ['submit']),
        onClose() {
            this.$emit("close");
        },
        reset() {
            this.email = null;
            this.first_name = null;
            this.last_name = null;
        },
        onSubmit() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.error = null;
                this.loading = true;
                this.submit(this.fields)
                    .then(response => {
                        this.error = null;
                        this.reset();
                        this.onClose();
                    })
                    .catch(response => {
                        let data = response;
                        let message = get(response, "message");

                        if (!isEmpty(message)) {
                            this.error = message;
                        } else if (!isEmpty(data)) {
                            let errors = get(data, "errors");
                            if (!isEmpty(errors)) {
                                if (isArray(errors)) {
                                    this.error = join(errors, "\n");
                                } else {
                                    this.error = errors;
                                }
                            }
                        } else {
                            this.error = "Failed Creating a new user";
                        }
                        this.$v.$reset();
                    })
                    .then(() => (this.loading = false));
            }
        }
    }
};
</script>