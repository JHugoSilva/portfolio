<script setup>
import { reactive, ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../lib/Api";

const form = reactive({
    email: "",
    password: "",
});

const router = useRouter();
const errors = ref("");

const handleSubmit = async () => {
    await api.post("/auth/login", form).then((response) => {
        if (response.data.success) {
            localStorage.setItem("token", response.data.data.token);
            localStorage.setItem("user", response.data.data.name);
            router.push("/admin/dashboard");
        } else {
            errors.value = response.data.message;
        }
    });
};
</script>
<template>
    <div class="account-container">
        <div class="account-card">
            <header>
                <h1 class="">Connect to a Portfolio account</h1>
                <p>Log into your account to post skills</p>
            </header>
            <span style="color: red" v-if="errors">{{ errors }}</span>
            <form @submit.prevent="handleSubmit">
                <label>Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    v-model="form.email"
                />

                <label for="password">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    v-model="form.password"
                />

                <button type="submit">Sign In</button>
                <br /><br />
                <p>
                    Don't have an account?
                    <a href="register.html" class="text-laravel">Register</a>
                </p>
            </form>
        </div>
    </div>
</template>
