<script setup>
import { reactive, ref } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    institution: "",
    period: "",
    degree: "",
    departement: "",
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
    form.institution = "";
    form.period = "";
    form.degree = "";
    form.departement = "";
};

EventBus.on("show-education-form", (education) => {
    showModal.value = true;
    editMode.value = true;
    form.id = education.id;
    form.institution = education.institution;
    form.period = education.period;
    form.degree = education.degree;
    form.departement = education.departement;
});

const handleSave = async (values, actions) => {
    if (editMode) {
        updateEducation(values, actions);
    } else {
        createEducation(values, actions);
    }
};

const createEducation = async (values, actions) => {
    await api.post("/v1/educations", form).then(({ data }) => {
        closeModal();
        toast.fire({
            icon: "success",
            title: "Education Added",
        });
        EventBus.emit("show-educations");
    });
};
const updateEducation = async (values, actions) => {
    await api.post(`/v1/educations/${form.id}`, form).then(({ data }) => {
        closeModal();
        toast.fire({
            icon: "success",
            title: "Education Updated",
        });
        EventBus.emit("show-educations");
    });
};
</script>
<template>
    <button class="open-modal" @click="openModal">New Education</button>
    <!-------------- EDUCATION MODAL --------------->
    <div class="modal" :class="showModal ? 'show' : ''">
        <div class="modal-content">
            <h2>
                <span v-if="editMode">Edit</span>
                <span v-else>Create</span>
                Education
            </h2>
            <span class="close-modal" @click="closeModal">×</span>
            <hr />
            <div>
                <label>Institution</label>
                <input type="text" v-model="form.institution" />

                <label>Period</label>
                <input type="text" v-model="form.period" />

                <label>Degree</label>
                <input type="text" v-model="form.degree" />

                <label>Department</label>
                <input type="text" v-model="form.departement" />
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
