<script setup>
import Base from "../../../layouts/Admin/Base.vue";
import Nav from "../../../layouts/Admin/Nav.vue";
import { onMounted, ref } from "vue";
import MediaForm from "./Form.vue";
import EventBus from "../../../lib/EventBus";
import api from "../../../lib/Api";

let medias = ref([]);

const deleteMedia = async (id) => {
    await api.delete(`/v1/medias/${id}`).then(({ data }) => {
        toast.fire({
            icon: "success",
            title: "Social Media Deleted",
        });
        getMedias();
    });
};

onMounted(async () => {
    await getMedias();
});

EventBus.on("show-medias", () => {
    getMedias();
});

const getMedias = async () => {
    await api.get("/v1/medias").then(({ data }) => {
        medias.value = data.medias;
    });
};
</script>
<template>
    <Base />
    <!--==================== MEDIAS SETTING ====================-->
    <section class="setting" id="setting">
        <div class="setting-wrapper">
            <div class="setting_nav">
                <div class="setting-titlebar">
                    <img
                        src="/public/template/assets/img/avatar.jpg"
                        alt=""
                        class="setting-avatar"
                    />
                    <p>Natalia Brakux</p>
                </div>
                <Nav />
            </div>
            <div class="setting_content">
                <section class="about" id="about">
                    <div class="titlebar">
                        <h1>Medias</h1>
                    </div>
                    <div class="card-wrappere">
                        <div class="card">
                            <h2>Social media</h2>
                            <div class="social_table-heading">
                                <p>Link</p>
                                <p>Icon</p>
                                <p></p>
                            </div>
                            <!-- item 1 -->
                            <div
                                class="social_table-items"
                                v-for="media in medias"
                                :key="media.id"
                            >
                                <p>{{ media.link }}</p>
                                <button class="service_table-icon">
                                    <i :class="media.icon"></i>
                                </button>
                                <button @click="deleteMedia(media?.id)">
                                    delete
                                </button>
                            </div>

                            <br />
                            <MediaForm />
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</template>
