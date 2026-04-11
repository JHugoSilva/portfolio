<script setup>
import { computed } from "vue";

const props = defineProps(["publications"]);

// Função para retornar o ícone baseado no tipo (seguindo o padrão uil)
const getIcon = (type) => {
    const icons = {
        Artigo: "file-alt",
        Repositório: "github",
        Tutorial: "video",
        "Deep Dive": "search-alt",
    };
    return icons[type] || "book-open";
};
</script>

<template>
    <section class="study section" id="studies">
        <h2 class="section__title">Estudos & Publicações</h2>
        <span class="section__subtitle">Conhecimento compartilhado</span>

        <div class="study_container container grid">
            <div
                v-for="(study, index) in publications"
                :key="index"
                class="study_content grid"
            >
                <div class="study_icon-box">
                    <i
                        :class="[
                            'uil',
                            `uil-${getIcon(study.type)}`,
                            'study_icon',
                        ]"
                    ></i>
                </div>

                <div class="study_data">
                    <h3 class="study_title">{{ study.title }}</h3>
                    <span class="study_type">{{ study.type }}</span>
                    <p class="study_description">
                        {{ study.description }}
                    </p>

                    <div class="study_tags">
                        <span
                            v-for="tag in study.tags"
                            :key="tag"
                            class="study_tag"
                        >
                            #{{ tag }}
                        </span>
                    </div>

                    <a
                        :href="study.link"
                        target="_blank"
                        class="button button--flex button--small"
                    >
                        Ler artigo
                        <i class="uil uil-arrow-right button__icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
/* Seguindo a lógica do seu home_container */
.study_container {
    gap: 2rem;
    grid-template-columns: repeat(2, 1fr);
}

.study_content {
    background-color: var(--container-color);
    padding: 2rem;
    border-radius: 0.75rem;
    display: flex;
    column-gap: 1.5rem;
    transition: 0.3s;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.study_content:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.study_icon {
    font-size: 2rem;
    color: var(--first-color);
}

.study_title {
    font-size: var(--h3-font-size);
    font-weight: var(--font-medium);
    margin-bottom: 0.25rem;
}

.study_type {
    display: block;
    font-size: var(--smaller-font-size);
    color: var(--text-color-light);
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.study_description {
    font-size: var(--small-font-size);
    margin-bottom: 1rem;
}

.study_tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
}

.study_tag {
    font-size: var(--smaller-font-size);
    color: var(--first-color);
}

/* Reutilizando a lógica de botão pequeno se existir no seu CSS */
.button--small {
    padding: 0.75rem 1rem;
    font-size: var(--small-font-size);
}

/* Responsividade seguindo o padrão home */
@media screen and (max-width: 768px) {
    .study_container {
        grid-template-columns: 1fr;
    }

    .study_content {
        padding: 1.5rem;
    }
}

@media screen and (max-width: 350px) {
    .study_content {
        flex-direction: column;
    }
    .study_icon-box {
        margin-bottom: 1rem;
    }
}
</style>
