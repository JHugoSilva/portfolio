<script setup>
import { onMounted, ref } from "vue";
import Form from "./Form.vue";
import EventBus from "../../../lib/EventBus";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const users = ref([]);

onMounted(async () => {
    getUsers();
});

EventBus.on("show-users", () => {
    getUsers();
});

const getUsers = async () => {
    await api.get("/v1/users").then(({ data }) => {
        users.value = data.users;
    });
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/avatar.jpg";
    }
};

const onEdit = (user) => {
    EventBus.emit("show-user-form", user);
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
            api.delete(`/v1/users/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getUsers();
            });
        }
    });
};
</script>
<template>
    <Base />
    <section class="users" id="users">
        <div class="titlebar">
            <h1>Users</h1>
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
                        <option value="">Filter User</option>
                    </select>
                </div>
                <div class="relative">
                    <input
                        class="search-input"
                        type="text"
                        name="search"
                        placeholder="Search User..."
                    />
                </div>
            </div>

            <div class="user_table-heading">
                <p>Photo</p>
                <p>Name</p>
                <p>Email</p>
                <p>Role</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div class="user_table-items" v-for="user in users" :key="user.id">
                <p>
                    <img
                        :src="ourImage(user.image)"
                        alt=""
                        class="user_img-list"
                    />
                </p>
                <p>{{ user.name }}</p>
                <p>{{ user.email }}</p>
                <p>{{ user.type }}</p>
                <div>
                    <button class="btn success" @click="onEdit(user)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn danger" @click="handleDelete(user.id)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>
