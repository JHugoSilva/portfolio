<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../../lib/Api";

const router = useRouter();
const route = useRoute();
const errors = ref([]);
const editMode = ref(false);

const form = reactive({
    name: "",
    function: "",
    testinomy: "",
    rating: "",
    image: "",
});

const getTestimonial = async () => {
    await api.get(`/v1/testimonials/${route.params.id}`).then(({ data }) => {
        form.name = data.testimonial.name;
        form.function = data.testimonial.function;
        form.testinomy = data.testimonial.testinomy;
        form.rating = data.testimonial.rating;
        form.image = data.testimonial.image;
    });
};

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateTestimonial(values, actions);
    } else {
        createTestimonial(values, actions);
    }
};

const createTestimonial = async (values, actions) => {
    const formData = new FormData();
    formData.append("name", form.name);
    formData.append("function", form.function);
    formData.append("testinomy", form.testinomy);
    formData.append("rating", form.rating);
    formData.append("image", form.image);

    await api
        .post("/v1/testimonials", formData)
        .then(({ data }) => {
            router.push("/admin/testimonials");
            toast.fire({
                icon: "success",
                title: "Testmonial Added",
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
};

const updateTestimonial = async (values, actions) => {
    const formData = new FormData();
    formData.append("name", form.name);
    formData.append("function", form.function);
    formData.append("testinomy", form.testinomy);
    formData.append("rating", form.rating);
    formData.append("image", form.image);

    await api
        .post(`/v1/testimonials/${route.params.id}`, formData)
        .then(({ data }) => {
            router.push("/admin/testimonials");
            toast.fire({
                icon: "success",
                title: "Testmonial Updated",
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + form.image;
    } else {
        return "/template/assets/img/no-image.png";
    }
};

const handleFileChange = (e) => {
    form.image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = () => {
        let output = document.getElementById("testimonial-img");
        output.src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
};

onMounted(() => {
    if (route.name === "admin.testimonials.edit") {
        editMode.value = true;
    }
    getTestimonial();
});
</script>
<template>
    <!--===================ADD testimonials ====================-->
    <section class="about">
        <div class="titlebar">
            <h1>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Testimonial
            </h1>
            <button @click="addTestimonial">Save Testimonial</button>
        </div>
        <div class="card-wrapper">
            <div class="wrapper_left">
                <div class="card">
                    <label>Name</label>
                    <span style="color: red" v-if="errors.name">{{
                        errors.name
                    }}</span>
                    <input type="text" v-model="form.name" />

                    <label>Function</label>
                    <span style="color: red" v-if="errors.function">{{
                        errors.function
                    }}</span>
                    <input type="text" v-model="form.function" />

                    <label>Testimony</label>
                    <textarea
                        cols="10"
                        rows="5"
                        v-model="form.testinomy"
                    ></textarea>
                    <label>Rating</label>
                    <input type="text" v-model="form.rating" />
                </div>
            </div>

            <div class="wrapper_right">
                <div class="card">
                    <img
                        :src="ourImage(form.image)"
                        class="avatar_img"
                        id="testimonial-img"
                    />
                    <input
                        type="file"
                        id="fileimg"
                        @change="handleFileChange"
                    />
                </div>
            </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <button @click="handleSave">Save Testimonial</button>
        </div>
    </section>
</template>
