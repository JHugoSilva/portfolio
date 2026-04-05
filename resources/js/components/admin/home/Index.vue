<script setup>
import { Chart } from "chart.js/auto";
import { onMounted, ref } from "vue";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const skillCount = ref(0);
const educationCount = ref(0);
const experienceCount = ref(0);
const serviceCount = ref(0);
const projectCount = ref(0);
const testimonialCount = ref(0);
const messageCount = ref(0);
const userCount = ref(0);
const projects = ref([]);
const testimonials = ref([]);
const skillChart = ref([]);
const services = ref([]);

onMounted(async () => {
    getDashboard();
});

const getDashboard = async () => {
    api.get("/v1/dashboard").then(({ data }) => {
        skillCount.value = data.skillCount;
        educationCount.value = data.educationCount;
        experienceCount.value = data.experienceCount;
        serviceCount.value = data.serviceCount;
        projectCount.value = data.projectCount;
        testimonialCount.value = data.testimonialCount;
        messageCount.value = data.messageCount;
        userCount.value = data.userCount;
        projects.value = data.projects;
        testimonials.value = data.testimonials;
        skillChart.value = data.skills;
        services.value = data.services;

        let Labels = new Array();
        let Data = new Array();

        skillChart.value.forEach((element) => {
            Labels.push(element.name);
            Data.push(element.proficiency);
        });

        const ctx = document.getElementById("myChart");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: Labels,
                datasets: [
                    {
                        label: "# of Skills",
                        data: Data,
                        borderWidth: 1,
                    },
                ],
            },
        });
    });
};

const ourImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/no-image.png";
    }
};
</script>
<template>
    <!-- Overview Page -->
    <Base />
    <section class="overview" id="overview">
        <div class="overview_left">
            <div class="titlebar">
                <h1 style="padding-left: 10px">Overview Dashboard</h1>
            </div>

            <!-- TOP CARDS -->
            <div class="overview_cards">
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Skills</p>
                        <span v-if="skillCount > 0">{{ skillCount }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/skills"
                            >View Skills</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Educations</p>
                        <span v-if="educationCount > 0">{{
                            educationCount
                        }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/educations"
                            >View Educations</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Experience</p>
                        <span v-if="experienceCount > 0">{{
                            experienceCount
                        }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/experiences"
                            >View Experiences</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Services</p>
                        <span v-if="serviceCount > 0">{{ serviceCount }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/services"
                            >View Services</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Projects</p>
                        <span v-if="projectCount > 0">{{ projectCount }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/projects"
                            >View Projects</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Testimonials</p>
                        <span v-if="testimonialCount > 0">{{
                            testimonialCount
                        }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/testimonials"
                            >View Testimonials</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Messages</p>
                        <span v-if="messageCount > 0">{{ messageCount }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/messages"
                            >View Messages</router-link
                        >
                    </div>
                </div>
                <div class="overview_cards-item card">
                    <div class="overview_data">
                        <p>Users</p>
                        <span v-if="userCount > 0">{{ userCount }}</span>
                    </div>
                    <div class="overview_link">
                        <span></span>
                        <router-link to="/admin/users">View Users</router-link>
                    </div>
                </div>
            </div>
            <!-- MEDIUM CARDS -->
            <div class="overview_table">
                <div>
                    <div class="titlebar">
                        <h1>Latest Projects</h1>
                    </div>
                    <div class="table ui-card">
                        <div class="overview_table-header">
                            <p>Image</p>
                            <p>Product</p>
                        </div>
                        <div
                            class="overview_table-items"
                            v-for="project in projects"
                            :key="project.id"
                        >
                            <img :src="ourImage(project.image)" />
                            <a>{{ project.title }}</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="titlebar">
                        <h1>Latest Testimonials</h1>
                    </div>
                    <div class="table">
                        <div class="overview_table-header">
                            <p>Image</p>
                            <p>Testimonial</p>
                        </div>
                        <div
                            class="overview_table-items"
                            v-for="testimonial in testimonials"
                            :key="testimonial.id"
                        >
                            <img
                                :src="ourImage(testimonial.image)"
                                style="height: 60px; width: 60px"
                            />
                            <a>{{ testimonial.testinomy }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overview_right">
            <div class="overview_analyse ui-card">
                <canvas id="myChart"></canvas>
            </div>
            <div class="titlebar">
                <h1>Skills</h1>
            </div>
            <div class="overview_skills">
                <div v-for="service in services" :key="service.id">
                    <div class="overview_skills-title">
                        <h2>{{ service.name }}</h2>
                    </div>
                    <div
                        class="skills_data"
                        v-for="skill in service.skills"
                        :key="skill.id"
                    >
                        <div class="skills_titles">
                            <h3 class="skills_name">{{ skill.name }}</h3>
                            <span class="skills_number"
                                >{{ skill.proficiency }}%</span
                            >
                        </div>
                        <div class="skills_bar">
                            <span
                                class="skills_percentage skills_html"
                                :style="{ whidth: `${skill.proficiency}` }"
                            ></span>
                        </div>
                    </div>

                    <br />
                </div>
            </div>
        </div>
    </section>
</template>
