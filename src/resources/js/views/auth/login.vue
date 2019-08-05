<template>
    <form class="form-signin" @submit.prevent>
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <label for="inputEmail" class="sr-only">Email address</label>

        <div v-if="error" class="row">
            <div class="col-12">
                <div class="alert alert-danger" v-html="error" />
            </div>
        </div>

        <input
            v-model="email"
            type="email"
            id="inputEmail"
            class="form-control"
            placeholder="Email address"
            required
            autofocus
        />
        <div v-if="$v.email.$error" class="text-danger">Email address is required.</div>
        <label for="inputPassword" class="sr-only">Password</label>
        <input
            v-model="password"
            type="password"
            id="inputPassword"
            class="form-control"
            placeholder="Password"
            required
        />
        <div v-if="$v.password.$error" class="text-danger">Password is required.</div>
        <button
            class="btn btn-lg btn-primary btn-block"
            type="submit"
            :disabled="loading"
            @keyup.enter="onSubmit"
            @click="onSubmit"
        >Sign in</button>
    </form>
</template>

<script>
import { mapActions } from "vuex";
import { validationMixin } from "vuelidate";
import { get, isEmpty, isArray, join } from "@/utils/lodash";
const { required, email } = require("vuelidate/lib/validators");
export default {
    mixins: [validationMixin],
    data: () => ({
        loading: false,
        error: null,
        email: 'eve.holt@reqres.in',
        password: 'cityslicka'
    }),
    validations: {
        email: {
            required,
            email
        },
        password: {
            required
        }
    },
    computed: {
        fields() {
            return {
                email: this.email,
                password: this.password
            }
        }
    },
    methods: {
        ...mapActions("auth", ["auth"]),
        onSubmit() {
            this.$v.$touch();
            if (!this.$v.$invalid) {
                this.error = null;
                this.loading = true;
                this.auth(this.fields)
                    .then(response => {
                        this.error = null;
                        this.$router.push({ name: "index" });
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
                            this.error =
                                "Email Address / Password combination is invalid.";
                        }
                        this.$v.$reset();
                    })
                    .then(() => (this.loading = false));
            }
        }
    }
};
</script>