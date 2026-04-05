<script setup>
import { reactive, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    id: "",
    name: "",
    icon: "",
    description: "",
});

const disabled = ref(false);

const errors = ref([]);

const showModal = ref(false);

const editMode = ref(false);

const openModal = () => {
    showModal.value = true;
    editMode.value = false;
};

const closeModal = () => {
    showModal.value = false;
    form.name = "";
    form.icon = "";
    form.description = "";
};

const handleSave = async (values, actions) => {
    if (editMode.value) {
        updateService(values, actions);
    } else {
        createService(values, actions);
    }
};

async function createService(values, actions) {
    disabled.value = true;
    await api
        .post("/v1/services", form)
        .then(({ data }) => {
            toast.fire({
                icon: "success",
                title: "Service Add!",
            });
            closeModal();
            EventBus.emit("show-services");
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

async function updateService(values, actions) {
    disabled.value = true;
    await api
        .post(`/v1/services/${form.id}`, form)
        .then(({ data }) => {
            toast.fire({
                icon: "success",
                title: "Service Updated!",
            });
            closeModal();
            EventBus.emit("show-services");
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.value.errors;
            }
        })
        .finally(() => {
            disabled.value = false;
        });
}

EventBus.on("show-service-form", (service) => {
    showModal.value = true;
    editMode.value = true;
    form.id = service.id;
    form.name = service.name;
    form.icon = service.icon;
    form.description = service.description;
});
</script>
<template>
    <!-------------- SERVICES MODAL --------------->
    <button class="open-modal" @click="openModal">New Service</button>
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Service
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr />
            <div>
                <label>Service Name</label>
                <span style="color: red" v-if="errors.name">{{
                    errors.name
                }}</span>
                <input type="text" v-model="form.name" />

                <label
                    >Icon Class
                    <span style="color: #006fbb"
                        >(Find your suitable icon: Font Awesome)</span
                    ></label
                >

                <input type="text" v-model="form.icon" />

                <label>Description</label>
                <textarea
                    cols="10"
                    rows="5"
                    v-model="form.description"
                ></textarea>
            </div>
            <hr />
            <div class="modal-footer">
                <button @click="closeModal">Cancel</button>
                <button class="secondary" @click="handleSave">
                    <span v-if="disabled"
                        ><i class="fa fa-spinner fa-spin"></i
                    ></span>
                    Save
                </button>
            </div>
        </div>
    </div>
</template>
