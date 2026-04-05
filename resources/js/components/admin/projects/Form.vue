<script setup>
import { onMounted, reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../../lib/Api";

const router = useRouter();
const route = useRoute();

const errors = ref([]);
const editMode = ref(false);

const form = reactive({
    title: "",
    description: "",
    link: "",
    image: "",
});

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateProject(values, actions);
    } else {
        createProject(values, actions);
    }
};

const createProject = async (values, actions) => {
    const formData = new FormData();
    formData.append("title", form.title);
    formData.append("description", form.description);
    formData.append("link", form.link);
    formData.append("image", form.image);

    await api
        .post("/v1/projects", formData)
        .then(({ data }) => {
            router.push("/admin/projects");
            toast.fire({
                icon: "success",
                title: "Project Added!",
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
};

const updateProject = async (values, actions) => {
    const formData = new FormData();
    formData.append("title", form.title);
    formData.append("description", form.description);
    formData.append("link", form.link);
    formData.append("image", form.image);

    await api
        .post(`/v1/projects/${route.params.id}`, formData)
        .then(({ data }) => {
            router.push("/admin/projects");
            toast.fire({
                icon: "success",
                title: "Project Updated!",
            });
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        });
};

const ourImage = () => {
    if (form.image) {
        return "/upload/" + form.image;
    } else {
        return "/template/assets/img/no-image.png";
    }
};

const handleFileChange = (e) => {
    form.image = e.target.files[0];
    let reader = new FileReader();
    reader.onload = () => {
        let output = document.getElementById("projects-img");
        output.src = reader.result;
    };
    reader.readAsDataURL(e.target.files[0]);
};

const getProject = async () => {
    await api.get(`/v1/projects/${route.params.id}`).then(({ data }) => {
        form.title = data.project.title;
        form.description = data.project.description;
        form.link = data.project.link;
        form.image = data.project.image;
    });
};

onMounted(() => {
    if (route.name === "admin.projects.edit") {
        editMode.value = true;
    }
    getProject();
});
</script>
<template>
    <!--===================ADD PROJECT ====================-->
    <section class="about" id="project">
        <div class="titlebar">
            <h1>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Project
            </h1>
            <button @click="handleSave">Save Project</button>
        </div>
        <div class="card-wrapper">
            <div class="wrapper_left">
                <div class="card">
                    <label>Title</label>
                    <span style="color: red" v-if="errors.title">{{
                        errors.title
                    }}</span>
                    <input type="text" v-model="form.title" />

                    <label>Description</label>
                    <span style="color: red" v-if="errors.description">{{
                        errors.description
                    }}</span>
                    <textarea
                        cols="10"
                        rows="5"
                        v-model="form.description"
                    ></textarea>

                    <label>Link</label>
                    <input type="text" v-model="form.link" />
                </div>
            </div>

            <div class="wrapper_right">
                <div class="card">
                    <img
                        :src="ourImage()"
                        id="projects-img"
                        alt=""
                        class="project_img"
                    />
                    <input type="file" @change="handleFileChange" />
                </div>
            </div>
        </div>
        <div class="titlebar">
            <h1></h1>
            <button @click="handleSave">Save Project</button>
        </div>
    </section>
</template>
