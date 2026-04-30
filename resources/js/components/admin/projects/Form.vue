<script setup>
import { reactive, ref } from "vue";
import { useProject } from "@/composables/projects/useProjects";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import { useImagePreview } from "../../../composables/images/useImagePreview";
import { useProjectData } from "../../../composables/admin/projects/useProjectData";
import { API_BASE_URL } from "../../../lib/URLBase";
import { getYoutubeMetaData } from "../../../services/youtubeService";

const { previewUrl, createPreview } = useImagePreview();
const { insertData, isLoading, error, success } = useProjectData(
    API_BASE_URL + "/v1/projects",
);

const errors = ref("");
const fileInput = ref(null);
const selectedFile = ref(null);
const editMode = ref(false);

const form = reactive({
    title: "",
    category: "",
    publicationIn: "",
    videoUrl: "",
    projectLink: "",
    longDescription: "",
});

const handleSubmit = async () => {
    const formData = new FormData();

    const meta = await getYoutubeMetaData(form.videoUrl);
    // const meta = await getYoutubeMetaData(form.videoUrl);
    formData.append(
        "title",
        form.title ? form.title.trim() : meta.title.trim(),
    );

    formData.append("category", form.category.trim()); //PREENCHIDO
    formData.append("publicationIn", form.publicationIn.trim()); //PREENCHIDO
    formData.append("videoUrl", meta.embedUrl); //PREENCHIDO
    formData.append("projectLink", form.projectLink.trim()); //PREENCHIDO GIT
    formData.append("longDescription", form.longDescription.trim()); //PREENCHIDO

    if (selectedFile.value) {
        formData.append("image", selectedFile.value);
    }

    const result = await insertData(formData);
    if (result) {
        form.title = "";
        form.category = "";
        form.publicationIn = "";
        form.videoUrl = "";
        form.projectLink = "";
        form.longDescription = "";
        selectedFile.value = null;
    }
};

const onFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        createPreview(file);
    }
};
</script>
<template>
    <!--===================ADD PROJECT ====================-->
    <section class="about" id="project">
        <div class="titlebar">
            <h1>
                <span v-if="editMode">Editar</span>
                <span v-else>Criar</span>
                Projeto
            </h1>
            <button @click="persistData" class="btn-save">
                Salvar Projeto
            </button>
        </div>

        <div class="card-wrapper">
            <div class="wrapper_left">
                <div class="card">
                    <label>Título</label>
                    <span style="color: red" v-if="errors?.title">{{
                        errors.title
                    }}</span>
                    <input
                        type="text"
                        v-model="form.title"
                        placeholder="Ex: E-commerce App"
                    />
                    <label>Categoria</label>
                    <span style="color: red" v-if="errors?.category">{{
                        errors.category
                    }}</span>
                    <input
                        type="text"
                        v-model="form.category"
                        placeholder="Ex: Web Design / Backend"
                    />

                    <label>Data</label>
                    <input
                        type="text"
                        v-model="form.publicationIn"
                        placeholder="Ex: Outubro, 2023"
                    />

                    <label>URL do Vídeo (YouTube Embed)</label>
                    <input
                        type="text"
                        v-model="form.videoUrl"
                        placeholder="https://www.youtube.com/embed/..."
                    />

                    <label>Link do Projeto (Online)</label>
                    <input
                        type="text"
                        v-model="form.projectLink"
                        placeholder="https://seuprojeto.com"
                    />

                    <label>Descrição Detalhada</label>
                    <span style="color: red" v-if="errors.longDescription">{{
                        errors.longDescription
                    }}</span>
                    <QuillEditor
                        theme="snow"
                        v-model:content="form.longDescription"
                        contentType="html"
                        toolbar="essential"
                    />
                </div>
            </div>

            <div class="wrapper_right">
                <div class="card">
                    <label>Thumbnail / Imagem de Capa</label>
                    <img
                        :src="previewUrl"
                        id="projects-img"
                        alt="Preview"
                        class="project_img"
                    />
                    <input type="file" @change="onFileChange" />
                    <p class="info-text">
                        Esta imagem aparecerá na listagem principal.
                    </p>
                </div>
            </div>
        </div>

        <div class="titlebar" style="margin-top: 2rem">
            <div class="spacer"></div>
            <button
                @click="handleSubmit"
                class="btn-save"
                :disabled="isLoading"
            >
                {{ isLoading ? "Salvando..." : "Salvar Projeto" }}
            </button>
        </div>
    </section>
</template>
<style scoped>
.editor-container {
    background-color: white;
    margin-bottom: 1.5rem;
}

:deep(.ql-editor) {
    min-height: 200px; /* Garante um espaço bom para digitar */
    font-size: 1rem;
}

:deep(.ql-toolbar) {
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    background-color: #f9f9f9;
}

:deep(.ql-container) {
    border-bottom-left-radius: 8px;
    border-bottom-right-radius: 8px;
}
</style>
