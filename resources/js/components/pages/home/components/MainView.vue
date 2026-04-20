<script setup>
import { onMounted, provide } from "vue";

import MainLayout from "../layouts/MainLayout.vue";
import AppHeader from "./AppHeader.vue";
import AppFooter from "./AppFooter.vue";

import About from "./views/About.vue";
import Home from "./views/Home.vue";
import Portfolio from "./views/Portfolio.vue";
import Project from "./views/Project.vue";
import Testimonial from "./views/Testimonial.vue";
import ContactMe from "./views/ContactMe.vue";
import Qualification from "./views/Qualification.vue";
import Service from "./views/Services.vue";
import Skill from "./views/Skills.vue";

import { usePortfolio } from "@/composables/portfolio/usePortfolio";
import { portfolioKey } from "@/composables/portfolio/keys";

const portfolio = usePortfolio();

provide(portfolioKey, portfolio); // O objeto 'portfolio' contém as refs reativas

onMounted(() => {
    portfolio.loadDataAll();
});
</script>

<template>
    <MainLayout>
        <template #header>
            <AppHeader />
        </template>
        <!--==================== MAIN ====================-->
        <main class="main">
            <section id="home"><Home /></section>
            <section id="about"><About /></section>
            <section id="skills"><Skill /></section>
            <section id="services"><Service /></section>
            <section id="qualification"><Qualification /></section>
            <!-- N<section id="portfolio"><Portfolio /></section> -->
            <section id="projects"><Project /></section>
            <!-- N<section id="testimonial"><Testimonial /></section> -->
            <section id="contact"><ContactMe /></section>
        </main>

        <template #footer>
            <AppFooter />
        </template>
    </MainLayout>
</template>
