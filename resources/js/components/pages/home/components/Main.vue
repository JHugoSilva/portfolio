<script setup>
import About from "./About.vue";
import Header from "./Header.vue";
import Home from "./Home.vue";
import Portfolio from "./Portfolio.vue";
import Project from "./Project.vue";
import Testimonial from "./Testimonial.vue";
import ContactMe from "./ContactMe.vue";
import Qualification from "./Qualification.vue";
import Service from "./Service.vue";
import Skill from "./Skill.vue";
import Footer from "./Footer.vue";
import api from "../../../../lib/Api";
import { onMounted, ref } from "vue";

const about = ref([]);
const skills = ref([]);
const educations = ref([]);
const experiences = ref([]);

const getAbout = async () => {
    await api.get("site/about").then((response) => {
        about.value = response.data.about;
    });
};

const getSkills = async () => {
    await api.get("site/skills").then((response) => {
        skills.value = response.data.skills;
    });
};

const getEducations = async () => {
    await api.get("site/educations").then((response) => {
        educations.value = response.data.educations;
    });
};

const getExperiences = async () => {
    await api.get("site/experiences").then((response) => {
        experiences.value = response.data.experiences;
    });
};

onMounted(async () => {
    getAbout();
    getSkills();
    getEducations();
    getExperiences();
});
</script>

<template>
    <!--==================== MAIN ====================-->
    <Header />
    <main class="main">
        <Home :about="about" />
        <About :about="about" />
        <Skill :skills="skills" />
        <Qualification :educations="educations" :experiences="experiences" />
        <Service />
        <Portfolio />
        <Project />
        <Testimonial />
        <ContactMe />
    </main>
    <Footer />
    <!--==================== SCROLL TOP ====================-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="uil uil-arrow-up scrollup_icon"></i>
    </a>
</template>
