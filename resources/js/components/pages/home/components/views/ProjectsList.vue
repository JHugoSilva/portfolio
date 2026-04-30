<script setup>
import { usePortfolioInject } from "@/composables/portfolio/usePortfolioInject";

const { projects } = usePortfolioInject();
</script>
<template>
    <section class="services section" id="services">
        <h2 class="section__title">Meus Projetos</h2>
        <span class="section__subtitle">Algumas de minhas habilidades</span>
        <div class="services_container container grid">
            <div class="services_content" v-for="project in projects">
                <!-- HEADER -->
                <div>
                    <i class="uil uil-web-grid services_icon"></i>
                    <h3 class="services_title">{{ project.title }}</h3>
                </div>

                <router-link
                    :to="{
                        name: 'ProjectDetails',
                        params: { id: project.id },
                    }"
                    class="button button--flex button--small"
                >
                    Ver Detalhes
                    <i class="uil uil-arrow-right button__icon"></i>
                </router-link>
            </div>
        </div>
    </section>
</template>
