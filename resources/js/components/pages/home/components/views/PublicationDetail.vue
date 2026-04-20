<script setup>
import { computed, onMounted, provide, ref, toRefs } from "vue";
import { useRoute } from "vue-router";

import { usePortfolio } from "@/composables/portfolio/usePortfolio";
import { portfolioKey } from "@/composables/portfolio/keys";

const portfolioProvider = usePortfolio();
provide(portfolioKey, portfolioProvider);

import { useProject } from "@/composables/projects/useProjects";
import { projectKey } from "@/composables/projects/keys";
const project = useProject();
provide(projectKey, project);

import MainLayout from "../../layouts/MainLayout.vue";
import AppHeader from "../AppHeader.vue";
import AppFooter from "../AppFooter.vue";

const route = useRoute();

const projectResponse = ref([]);
// Isso transforma os refs internos em variáveis locais reativas
const { medias } = toRefs(portfolioProvider);

onMounted(async () => {
    await portfolioProvider.loadAll();
    await project.getProject();
    projectResponse.value = project.projectValue?.value;
});
</script>
<template>
    <MainLayout>
        <template #header>
            <AppHeader />
        </template>
        <!--==================== MAIN ====================-->
        <main class="main">
            <section class="publication section" id="publication">
                <div
                    class="publication_container container grid"
                    v-if="projectResponse.id"
                >
                    <div class="publication_video-content">
                        <div class="video_wrapper">
                            <iframe
                                width="100%"
                                height="315"
                                :src="projectResponse.videoUrl"
                                title="Video player"
                                frameborder="0"
                                allow="
                                    accelerometer;
                                    autoplay;
                                    clipboard-write;
                                    encrypted-media;
                                    gyroscope;
                                    picture-in-picture;
                                "
                                allowfullscreen
                                referrerpolicy="strict-origin-when-cross-origin"
                                class="publication_video"
                            ></iframe>
                        </div>
                    </div>

                    <div class="publication_data">
                        <h1 class="publication_title">
                            {{ projectResponse.title }}
                        </h1>
                        <h3 class="publication_subtitle">
                            {{ projectResponse.category }}
                        </h3>

                        <div class="publication_meta">
                            <span class="publication_date">
                                <i class="uil uil-calendar-alt"></i>
                                {{ projectResponse.date }}
                            </span>
                        </div>

                        <p
                            class="publication_description"
                            v-html="projectResponse.longDescription"
                        ></p>

                        <div class="publication_buttons">
                            <a
                                :href="projectResponse.projectLink"
                                target="_blank"
                                class="button button--flex"
                            >
                                Ver Projeto Online
                                <i
                                    class="uil uil-external-link-alt button__icon"
                                ></i>
                            </a>

                            <router-link
                                to="/"
                                class="button button--flex button--ghost"
                            >
                                Voltar ao Portfólio
                            </router-link>
                        </div>

                        <div class="publication_share">
                            <span class="home_social-follow">Compartilhar</span>
                            <div class="home_social1">
                                <div class="social-container">
                                    <a
                                        v-for="media in medias"
                                        :key="media.id"
                                        :href="media.link"
                                        target="_blank"
                                        class="home_social-icon"
                                    >
                                        <i
                                            :class="[
                                                'uil',
                                                `uil-${media.icon}`,
                                            ]"
                                        ></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div v-else class="container">
                    <p>Carregando detalhes do projeto...</p>
                </div>
            </section>
        </main>
        <!--==================== SCROLL TOP ====================-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="uil uil-arrow-up scrollup_icon"></i>
        </a>
        <template #footer>
            <AppFooter />
        </template>
    </MainLayout>
</template>

<style scoped>
/* Ajustes para manter o padrão do seu layout */
.publication_container {
    gap: 3rem;
}

.video_wrapper {
    position: relative;
    padding-bottom: 56.25%; /* Proporção 16:9 */
    height: 0;
    overflow: hidden;
    border-radius: 0.75rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.video_wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.publication_title {
    font-size: var(--h1-font-size);
    margin-bottom: var(--mb-0-75);
}

.publication_subtitle {
    font-size: var(--h3-font-size);
    color: var(--first-color);
    margin-bottom: var(--mb-1);
}

.publication_meta {
    display: flex;
    margin-bottom: var(--mb-2);
    font-size: var(--small-font-size);
    color: var(--text-color-light);
}

.publication_buttons {
    display: flex;
    gap: 1rem;
    margin-bottom: var(--mb-3);
    flex-wrap: wrap;
}

.button--ghost {
    background-color: transparent;
    color: var(--first-color);
    border: 2px solid var(--first-color);
}

.social-container {
    display: flex; /* Alinha os filhos em linha */
    flex-direction: row; /* Garante que fiquem lado a lado */
    gap: 1.5rem; /* Cria um espaço entre os ícones sem precisar de margin */
    align-items: center; /* Alinha verticalmente ao centro, se necessário */
}

.home_social-icon {
    font-size: 1.25rem; /* Tamanho do ícone */
    color: #333; /* Cor padrão */
    transition: 0.3s;
}

.home_social-icon:hover {
    color: #6c63ff; /* Cor ao passar o mouse */
}

/* Responsividade */
@media screen and (max-width: 767px) {
    .publication_container {
        grid-template-columns: 1fr;
    }
}
</style>
