<script setup>
import { onMounted, reactive, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    name: "",
    proficiency: "",
    service_id: "",
});

const services = ref([]);
const errors = ref([]);
const showModal = ref(false);

const disabled = ref(false);

const closeModal = () => {
    showModal.value = false;
    form.name = "";
    form.proficiency = "";
    form.service_id = "";
};

const openModal = () => {
    showModal.value = true;
};

const getServices = async () => {
    await api.get("/v1/services").then(({ data }) => {
        services.value = data.services;
    });
};

const handleSave = async () => {
    await api
        .post("/v1/skills", form)
        .then(({ data }) => {
            closeModal();
            toast.fire({
                icon: "success",
                title: "Skill Added",
            });
            EventBus.emit("show-skills");
        })
        .catch((error) => {
            if (error.response.status === 422) {
                errors.value = error.response.data.errors;
            }
        })
        .finally(() => {
            disabled.value = false;
        });
};

onMounted(async () => {
    await getServices();
});
</script>
<template>
    <!-------------- SKILLS MODAL --------------->
    <button class="open-modal" @click="openModal">New Skill</button>
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>Create Skill</h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr />
            <div>
                <p>Name</p>
                <span style="color: red" v-if="errors.name">{{
                    errors.name
                }}</span>
                <input type="text" class="input" v-model="form.name" />

                <p>Proficiency</p>
                <span style="color: red" v-if="errors.proficiency">{{
                    errors.proficiency
                }}</span>
                <input type="text" class="input" v-model="form.proficiency" />

                <p>Service</p>
                <select
                    class="inputSelect"
                    name=""
                    id=""
                    v-model="form.service_id"
                >
                    <option disabled>Select Service</option>
                    <option
                        :value="service.id"
                        v-for="service in services"
                        :key="service.id"
                    >
                        {{ service.name }}
                    </option>
                </select>
            </div>
            <hr />
            <div class="modal-footer">
                <button class="close-modal" @click="closeModal">Cancel</button>
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
