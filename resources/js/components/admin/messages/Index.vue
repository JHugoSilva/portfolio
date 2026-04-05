<script setup>
import { onMounted, ref } from "vue";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const messages = ref([]);

const getMessages = async () => {
    await api.get("/v1/messages").then(({ data }) => {
        messages.value = data.messages;
        console.log(messages.value);
    });
};

const changeStatus = async (id) => {
    await api.post(`/v1/messages/${id}`).then(({ data }) => {
        getMessages();
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
            api.delete(`/v1/messages/${id}`).then(() => {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success",
                });
                getMessages();
            });
        }
    });
};

onMounted(async () => {
    getMessages();
});
</script>
<template>
    <Base />
    <section class="messages">
        <div class="messages_container">
            <div class="titlebar">
                <h1>Messages</h1>
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
                            <option value="">Filter Message</option>
                        </select>
                    </div>
                    <div class="relative">
                        <input
                            class="search-input"
                            type="text"
                            name="search"
                            placeholder="Search Message..."
                        />
                    </div>
                </div>

                <div class="message_table-heading">
                    <p>Name</p>
                    <p>Email</p>
                    <p>Subject</p>
                    <p>Description</p>
                    <p>Status</p>
                    <p>Actions</p>
                </div>
                <!-- item 1 -->
                <div
                    class="message_table-items"
                    v-for="message in messages"
                    :key="message.id"
                >
                    <p>{{ message.name }}</p>
                    <p>{{ message.email }}</p>
                    <p>{{ message.subject }}</p>
                    <p>
                        {{ message.description }}
                    </p>
                    <p @click="changeStatus(message.id)">
                        <span class="badge_read" v-if="message.status == '1'">
                            Read
                        </span>
                        <span class="badge_unread" v-else> Unread </span>
                    </p>
                    <div>
                        <button
                            class="btn danger"
                            @click="handleDelete(message.id)"
                        >
                            <i class="far fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
