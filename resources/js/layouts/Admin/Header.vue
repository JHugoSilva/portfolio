<script setup>
import { onBeforeMount, ref } from "vue";
import api from "../../lib/Api";

const user = ref([]);
const showProfileNav = ref(false);

onBeforeMount(async () => {
    getAuthUser();
});

const toggleProfileNav = () => {
    showProfileNav.value = !showProfileNav.value;
};

const getAuthUser = async () => {
    let token = localStorage.getItem("token");
    await api.get(`/auth/profile/${token}`).then((response) => {
        user.value = response.data.user;
    });
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/no-image.png";
    }
};

const logOut = async () => {
    let token = localStorage.getItem("token");
    await api.delete(`/auth/logout/${token}`).then((response) => {
        localStorage.removeItem("token");
        localStorage.removeItem("user");
        window.location = "/";
    });
};
</script>

<template>
    <header>
        <nav>
            <ul>
                <li>
                    <img src="/public/template/assets/img/logo.png" alt="" />
                </li>
            </ul>
            <ul class="header-profile" @click="toggleProfileNav">
                <li class="avatar-item">
                    <img
                        :src="ourImage(user.image)"
                        alt=""
                        class="avatar-img"
                    />
                </li>
                <li>
                    <span>{{ user.email }}</span>
                </li>
            </ul>
        </nav>
        <span class="header-profile-nav" :class="showProfileNav ? 'show' : ''">
            <span> <i class="fa fa-sort-up"></i></span>
            <ul>
                <li><a href="profile.html">Profile</a></li>
                <hr class="hr" />
                <li><a href="#">Message</a></li>
                <hr class="hr" />
                <li @click="logOut"><a href="#">Logout</a></li>
            </ul>
        </span>
    </header>
</template>
