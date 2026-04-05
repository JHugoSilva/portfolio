<script setup>
import { reactive, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    company: "",
    period: "",
    position: "",
});

const showModal = ref(false);
const editMode = ref(false);
const disabled = ref(false);

const errors = ref([]);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editMode.value = false;
    form.id = "";
    form.company = "";
    form.period = "";
    form.position = "";
};

EventBus.on("show-experience-form", (experience) => {
    showModal.value = true;
    editMode.value = true;
    form.id = experience.id;
    form.company = experience.company;
    form.period = experience.period;
    form.position = experience.position;
});

const handleSave = async (values, actions) => {
    if (editMode) {
        updateExperience(values, actions);
    } else {
        createExperience(values, actions);
    }
};

const createExperience = async (values, actions) => {
    await api.post("/v1/experiences", form).then(({ data }) => {
        closeModal();
        toast.fire({
            icon: "success",
            title: "Experience Added",
        });
        EventBus.emit("show-experiences");
    });
};

const updateExperience = async (values, actions) => {
    await api.post(`/v1/experiences/${form.id}`, form).then(({ data }) => {
        closeModal();
        toast.fire({
            icon: "success",
            title: "Experience Updated",
        });
        EventBus.emit("show-experiences");
    });
};
</script>
<template>
    <button class="open-modal" @click="openModal">New Experience</button>
    <!-------------- EXPERIENCE MODAL --------------->
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Experience
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr />
            <div>
                <p>Company</p>
                <input type="text" v-model="form.company" />

                <p>Period</p>
                <input type="text" v-model="form.period" />

                <p>Position</p>
                <input type="text" v-model="form.position" />
            </div>
            <hr />
            <div class="modal-footer">
                <button class="close-modal" @click="closeModal">Cancel</button>
                <button class="secondary" @click="handleSave">
                    <span v-if="disabled"
                        ><i class="fa fa-spinner fa-spin"></i></span
                    >Save
                </button>
            </div>
        </div>
    </div>
</template>
