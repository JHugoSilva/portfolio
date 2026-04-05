<script setup>
import { onMounted, ref, watch } from "vue";
import { useRouter } from "vue-router";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const projects = ref([]);
const links = ref([]);
const searchQuery = ref([]);
const router = useRouter();

onMounted(async () => {
    await getProjects();
});

watch(searchQuery, () => {
    getProjects();
});

const addProject = () => {
    router.push("/admin/projects/create");
};

const onEdit = (id) => {
    router.push(`/admin/projects/${id}/edit`);
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/no-image.png";
    }
};

const getProjects = async () => {
    await api
        .get("/v1/projects")
        .then(({ data }) => {
            projects.value = data.projects.data;
            links.value = data.projects.links;
        })
        .catch((error) => {
            console.log(error);
        });
};

const changePage = (link) => {
    if (!link.url || link.active) {
        return;
    }

    api.get(link.url).then(({ data }) => {
        projects.value = data.projects.data;
        links.value = data.projects.links;
    });
};

const handleDelete = (id) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able ro revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            api.delete(`/v1/projects/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getProjects();
            });
        }
    });
};
</script>
<template>
    <Base />
    <!--==================== PROJECTS ====================-->
    <section class="projects" id="projects">
        <div class="titlebar">
            <h1>Projects</h1>
            <button class="btn__open--modal" @click="addProject">
                New Project
            </button>
        </div>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">
                <div>
                    <select class="search-select" name="" id="">
                        <option value="">Filter Project</option>
                    </select>
                </div>
                <div class="relative">
                    <input
                        class="search-input"
                        type="text"
                        name="search"
                        placeholder="Search Project..."
                    />
                </div>
            </div>

            <div class="project_table-heading">
                <p>Image</p>
                <p>Title</p>
                <p>Description</p>
                <p>Link</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
                class="project_table-items"
                v-for="project in projects"
                :key="project.id"
            >
                <p>
                    <img
                        :src="ourImage(project.image)"
                        alt=""
                        class="project_img-list"
                    />
                </p>
                <p>{{ project.title }}</p>
                <p>{{ project.description }}</p>
                <p>{{ project.links }}</p>
                <div>
                    <button class="btn success" @click="onEdit(project.id)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                        class="btn danger"
                        @click="handleDelete(project.id)"
                    >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <button
                        v-for="(link, index) in links"
                        :key="index"
                        class="btn"
                        :class="{ active: link.active }"
                        :disabled="!link.url"
                        @click="changePage(link)"
                        v-html="link.label"
                    ></button>
                </div>
            </div>
        </div>
    </section>
</template>
