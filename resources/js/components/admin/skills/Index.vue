<script setup>
import { onMounted, ref } from "vue";
import Form from "./Form.vue";
import EventBus from "../../../lib/EventBus";
import Base from "../../../layouts/Admin/Base.vue";
import api from "../../../lib/Api";

const skills = ref([]);

EventBus.on("show-skills", () => {
    getSkills();
});

const getSkills = async () => {
    await api.get("/v1/skills").then(({ data }) => {
        skills.value = data.skills;
    });
};

onMounted(async () => {
    await getSkills();
});
</script>
<template>
    <Base />
    <!--==================== SKILLS ====================-->
    <section class="skills" id="skills">
        <div class="titlebar">
            <h1>Skills</h1>
            <Form />
        </div>
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <p class="table-filter-link link-active">All</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="table-search">
                <div>
                    <select class="search-select" name="" id="">
                        <option value="">Filter Skills</option>
                    </select>
                </div>
                <div class="relative">
                    <input
                        class="search-input"
                        type="text"
                        name="search"
                        placeholder="Search Skill..."
                    />
                </div>
            </div>

            <div class="skill_table-heading">
                <p>Name</p>
                <p>Proficiency</p>
                <p>Service</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            <div
                class="skill_table-items"
                v-for="skill in skills"
                :key="skill.id"
            >
                <p>{{ skill.name }}</p>
                <div class="table_skills-bar">
                    <span
                        class="table_skills-percentage"
                        :style="{ width: `${skill.proficiency}%` }"
                    ></span>
                    <strong>{{ skill.proficiency }}%</strong>
                </div>
                <p v-if="skill.service">{{ skill.service.name }}</p>
                <div>
                    <button class="btn-icon success">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="btn-icon danger">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            <div class="table-paginate">
                <div class="pagination">
                    <a href="#" class="btn">&laquo;</a>
                    <a href="#" class="btn active">1</a>
                    <a href="#" class="btn">2</a>
                    <a href="#" class="btn">3</a>
                    <a href="#" class="btn">&raquo;</a>
                </div>
            </div>
        </div>
    </section>
</template>
