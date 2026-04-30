<script setup>
import { defineAsyncComponent } from "vue";

const Home = defineAsyncComponent(() => import("./views/Home.vue"));
const About = defineAsyncComponent(() => import("./views/About.vue"));
const Portfolio = defineAsyncComponent(() => import("./views/Portfolio.vue"));
const ProjectCards = defineAsyncComponent(
    () => import("./views/ProjectCards.vue"),
);

const Testimonial = defineAsyncComponent(
    () => import("./views/Testimonial.vue"),
);
const ContactMe = defineAsyncComponent(() => import("./views/ContactMe.vue"));
const Qualification = defineAsyncComponent(
    () => import("./views/Qualification.vue"),
);
const Services = defineAsyncComponent(() => import("./views/Services.vue"));
const Skills = defineAsyncComponent(() => import("./views/Skills.vue"));
</script>

<template>
    <!--==================== MAIN ====================-->
    <main class="main">
        <section id="home"><Home /></section>
        <section id="about"><About /></section>
        <section id="skills"><Skills /></section>
        <section id="services"><Services /></section>
        <section id="qualification"><Qualification /></section>
        <section id="projects"><ProjectCards /></section>
        <section id="contact"><ContactMe /></section>
    </main>
</template>
