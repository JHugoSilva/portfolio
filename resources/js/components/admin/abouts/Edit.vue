<script setup>
import { onMounted, reactive, ref } from "vue";
import Nav from "../../../layouts/Admin/Nav.vue";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";
const form = reactive({
    name: "",
    home_image: "",
    banner_image: "",
    phone: "",
    email: "",
    address: "",
    description: "",
    summary: "",
    tagline: "",
    cv: "",
});

let errors = ref([]);

const getAbout = async () => {
    await api.get("/v1/about").then(({ data }) => {
        form.name = data.data.name;
        form.home_image = data.data.home_image;
        form.banner_image = data.data.banner_image;
        form.phone = data.data.phone;
        form.email = data.data.email;
        form.address = data.data.address;
        form.description = data.data.description;
        form.summary = data.data.summary;
        form.tagline = data.data.tagline;
        form.cv = data.data.cv;
        console.log("Edit", data);
    });
};

const getHomeImage = () => {
    if (form.home_image) {
        return "/upload/" + form.home_image;
    } else {
        return "/template/assets/img/avatar.jpg";
    }
};

const getBannerImage = () => {
    if (form.banner_image) {
        return "/upload/" + form.banner_image;
    } else {
        return "/template/assets/img/avatar.jpg";
    }
};

const handleHomeImageChange = (e) => {
    form.home_image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = () => {
        let output = document.getElementById("home-img");
        output.src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
};

const handleBannerImageChange = (e) => {
    form.banner_image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = () => {
        let output = document.getElementById("banner-img");
        output.src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
};

const handlePdfChange = (e) => {
    form.cv = e.target.files[0];
};

const handleSave = async () => {
    const formData = new FormData();
    formData.append("name", form.name);
    formData.append("email", form.email);
    formData.append("phone", form.phone);
    formData.append("address", form.address);
    formData.append("description", form.description);
    formData.append("summary", form.summary);
    formData.append("tagline", form.tagline);
    formData.append("home_image", form.home_image);
    formData.append("banner_image", form.banner_image);
    formData.append("cv", form.cv);

    await api
        .post("/v1/about", formData)
        .then(({ data }) => {
            toast.fire({
                icon: "success",
                title: "About me Updated",
            });
            console.log(data);

            getAbout();
        })
        .catch((error) => {
            if (error.response.status === 422) {
                console.log("====================================");
                errors.value = error.response.data.errors;
                console.log("====================================");
            }
        });
};

onMounted(async () => {
    await getAbout();
});
</script>
<template>
    <Base />
    <!--==================== ABOUT ====================-->
    <section class="setting" id="setting">
        <div class="setting-wrapper">
            <div class="setting_nav">
                <div class="setting-titlebar">
                    <img
                        src="/public/template/assets/img/avatar.jpg"
                        alt=""
                        class="setting-avatar"
                    />
                    <p>Natalia Brakux</p>
                </div>
                <Nav />
            </div>
            <div class="setting_content">
                <section class="about" id="about">
                    <div class="titlebar">
                        <h1>About Me</h1>
                        <button class="secondary" @click="handleSave">
                            Update Changes
                        </button>
                    </div>
                    <div class="card-wrapper">
                        <div class="wrapper_left">
                            <div class="card">
                                <label>Full Name</label>
                                <span style="color: red" v-if="errors.name">{{
                                    errors.name
                                }}</span>
                                <input type="text" v-model="form.name" />

                                <label>Email</label>
                                <span style="color: red" v-if="errors.email">{{
                                    errors.email
                                }}</span>
                                <input type="email" v-model="form.email" />

                                <label>Phone</label>
                                <input type="text" v-model="form.phone" />

                                <label>Address</label>
                                <input type="text" v-model="form.address" />

                                <label>Description</label>
                                <textarea
                                    type="text"
                                    cols="10"
                                    rows="3"
                                    v-model="form.description"
                                ></textarea>

                                <label>Summary</label>
                                <textarea
                                    type="text"
                                    cols="10"
                                    rows="2"
                                    v-model="form.summary"
                                ></textarea>
                            </div>
                            <div class="card">
                                <label>Tagline</label>
                                <input type="text" v-model="form.tagline" />
                            </div>
                        </div>
                        <div class="wrapper_right">
                            <div class="card">
                                <label>Home Image</label>
                                <img
                                    :src="getHomeImage()"
                                    class="avatar_img"
                                    id="home-img"
                                />
                                <input
                                    type="file"
                                    @change="handleHomeImageChange"
                                />
                            </div>
                            <div class="card">
                                <label>About Image</label>
                                <img
                                    :src="getBannerImage()"
                                    class="avatar_img"
                                    id="banner-img"
                                />
                                <input
                                    type="file"
                                    @change="handleBannerImageChange"
                                />
                            </div>
                            <div class="card">
                                <p>CV</p>
                                <input
                                    accept="pdf/*"
                                    type="file"
                                    @change="handlePdfChange"
                                />
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section></section>
    </section>
</template>
