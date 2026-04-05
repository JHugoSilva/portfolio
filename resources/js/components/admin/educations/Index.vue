<script setup>
import { onMounted, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import Form from "./Form.vue";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const educations = ref([]);

onMounted(async () => {
    await getEducations();
});

EventBus.on("show-educations", () => {
    getEducations();
});

const getEducations = async () => {
    await api.get("/v1/educations").then(({ data }) => {
        educations.value = data.educations;
    });
};

const onEdit = (education) => {
    EventBus.emit("show-education-form", education);
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
            api.delete(`/v1/educations/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getEducations();
            });
        }
    });
};
</script>

<template>
    <Base />
    <!--==================== EDUCATIONS ====================-->
    <section class="educations" id="educations">
        <div class="titlebar">
            <h1>Educations</h1>
            <Form />
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
                        <option value="">Filter Service</option>
                    </select>
                </div>
                <div class="relative">
                    <input
                        class="search-input"
                        type="text"
                        name="search"
                        placeholder="Search Service..."
                    />
                </div>
            </div>

            <div class="education_table-heading">
                <p>Institution</p>
                <p>Period</p>
                <p>Degree</p>
                <p>Department</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
                class="education_table-items"
                v-for="education in educations"
                :key="education.id"
            >
                <p>{{ education.institution }}</p>
                <p>{{ education.period }}</p>
                <p>{{ education.degree }}</p>
                <p>{{ education.departement }}</p>
                <div>
                    <button class="btn-icon success" @click="onEdit(education)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                        class="btn-icon danger"
                        @click="handleDelete(education.id)"
                    >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
