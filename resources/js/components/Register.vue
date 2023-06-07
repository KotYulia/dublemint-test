<template>
    <div class="container my-5">
        <div class="register-block d-flex flex-column align-items-center">
            <div class="mx-auto col-6">
                <h2>Create New Account</h2>
                <p id="personal-link"></p>
            </div>
            <form action="#" class="form col-6" @submit.prevent="register">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username">Username</label>
                        <input v-model="form.username" type="text"
                               id="username"
                               placeholder="Username"
                               class="form-control"
                               :class="{ 'is-invalid': form.errors.has('username') }"
                               name="username">
                        <has-error :form="form" field="username"></has-error>
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="form-group col-md-6">
                        <label for="phone">Phone Number</label>
                        <input v-model="form.phone" type="text"
                               id="phone"
                               placeholder="Phone Number"
                               class="form-control"
                               :class="{ 'is-invalid': form.errors.has('phone') }"
                               name="phone">
                        <has-error :form="form" field="phone"></has-error>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-dark">Sign Up</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "Register",

    data () {
        return {
            form: new Form({
                username: '',
                phone: '',
            })
        }
    },
    methods: {
        register () {
            this.form.post('/api/register')
                .then(( response ) => {
                    const attr = document.getElementById("personal-link");
                    attr.innerHTML = response.data.message;
                    this.form.reset();
                })
        },
    }
}
</script>

<style scoped>

</style>
