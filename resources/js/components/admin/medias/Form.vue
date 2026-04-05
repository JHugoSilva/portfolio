<script setup>
import { reactive } from "vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

const form = reactive({
    link: "",
    icon: "",
});

const handleSave = async () => {
    await api.post("/v1/medias", form).then((data) => {
        toast.fire({
            icon: "success",
            title: "Social Media Added",
        });
        ((form.link = ""), (form.icon = ""), EventBus.emit("show-medias"));
    });
};
</script>
<template>
    <div class="social_table-heading">
        <p>Link</p>
        <span style="color: #006fbb">(Find your icon class: Font Awesome)</span>
        <p></p>
    </div>
    <p></p>
    <div class="social_table-items">
        <input type="text" v-model="form.link" />

        <input type="text" v-model="form.icon" />
        <button @click="handleSave">Add Media</button>
    </div>
</template>
