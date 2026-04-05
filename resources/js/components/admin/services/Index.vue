<script setup>
import { onMounted, ref } from "vue";
import Form from "./Form.vue";
import EventBus from "../../../lib/EventBus";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

let services = ref([]);

onMounted(async () => {
    await getServices();
});

EventBus.on("show-services", () => {
    getServices();
});

const getServices = async () => {
    await api.get("/v1/services").then(({ data }) => {
        services.value = data.services;
    });
};

const onEdit = (service) => {
    EventBus.emit("show-service-form", service);
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
            api.delete(`/v1/services/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getServices();
            });
        }
    });
};
</script>

<template>
    <Base />
    <!--==================== SERVICES ====================-->
    <section class="services" id="services">
        <div class="titlebar">
            <h1>Services</h1>
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
            <div class="service_table-heading">
                <p>Title</p>
                <p>Icon</p>
                <p>Description</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
                class="service_table-items"
                v-for="service in services"
                :key="service.id"
            >
                <p>{{ service.name }}</p>
                <button class="service_table-icon">
                    <i class="fas fa-pencil-alt"></i>
                </button>
                <p>
                    {{ service.description }}
                </p>
                <div>
                    <button class="btn-icon success" @click="onEdit(service)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button
                        class="btn-icon danger"
                        @click="handleDelete(service.id)"
                    >
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
