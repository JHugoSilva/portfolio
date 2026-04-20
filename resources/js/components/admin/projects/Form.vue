<script setup>
import { useProject } from "@/composables/projects/useProjects";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";

const {
    form,
    errors,
    editMode,
    getImagePreview,
    handleFileChange,
    persistData,
} = useProject();
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
                        v-model="form.date"
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
                        :src="getImagePreview()"
                        id="projects-img"
                        alt="Preview"
                        class="project_img"
                    />
                    <input type="file" @change="handleFileChange" />
                    <p class="info-text">
                        Esta imagem aparecerá na listagem principal.
                    </p>
                </div>
            </div>
        </div>

        <div class="titlebar" style="margin-top: 2rem">
            <div class="spacer"></div>
            <button @click="handleSave" class="btn-save">Salvar Projeto</button>
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
