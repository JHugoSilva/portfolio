<script setup>
import { reactive, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    name: "",
    email: "",
    type: "",
    bio: "",
    password: "",
});
const disabled = ref(false);
const showModal = ref(false);
const errors = ref(false);
const editMode = ref(false);

EventBus.on("show-user-form", (user) => {
    showModal.value = true;
    editMode.value = true;
    form.id = user.id;
    form.name = user.name;
    form.email = user.email;
    form.bio = user.bio;
    form.type = user.type;
    form.password = user.password;
});

const openModal = () => {
    showModal.value = true;
    editMode.value = false;
};

const closeModal = () => {
    showModal.value = false;
    form.name = "";
    form.email = "";
    form.bio = "";
    form.type = "";
    form.password = "";
};

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateUser(values, actions);
    } else {
        createUser(values, actions);
    }
};

async function createUser(values, actions) {
    disabled.value = true;

    await api
        .post("/v1/users", form)
        .then(({ data }) => {
            closeModal();
            toast.fire({
                icon: "success",
                title: "User Added!",
            });
            EventBus.emit("show-users");
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        })
        .finally(() => {
            disabled.value = false;
        });
}

async function updateUser(values, actions) {
    disabled.value = true;
    await api
        .post(`/v1/users/${form.id}`, form)
        .then(({ data }) => {
            closeModal();
            toast.fire({
                icon: "success",
                title: "User Updated!",
            });
            EventBus.emit("show-users");
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        })
        .finally(() => {
            disabled.value = false;
        });
}
</script>
<template>
    <button class="open-modal" @click="openModal">New User</button>
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Editar</span>
                <span v-else>Create</span>
                User
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr />
            <div>
                <label>Name</label>
                <span v-if="errors.name" style="color: red">
                    {{ errors.name[0] }}
                </span>
                <input type="text" v-model="form.name" />

                <label>Email</label>
                <span v-if="errors.email" style="color: red">
                    {{ errors.email[0] }}
                </span>
                <input type="text" v-model="form.email" />

                <label>Bio</label>
                <textarea cols="20" rows="3" v-model="form.bio"></textarea>

                <p>Type</p>
                <select name="" id="" v-model="form.type">
                    <option disabled>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">Standard User</option>
                </select>

                <label
                    >Password
                    <span
                        >Leave blank if you don't want to change password</span
                    >
                </label>
                <input type="password" id="password" v-model="form.password" />
            </div>
            <hr />
            <div class="modal-footer">
                <button class="close-modal" @click="closeModal">Cancel</button>
                <button class="secondary close-modal" @click="handleSave">
                    <span v-if="disabled"
                        ><i class="fa fa-spinner fa-spin"></i
                    ></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
