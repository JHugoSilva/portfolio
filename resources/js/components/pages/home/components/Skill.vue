<script setup>
import { ref, computed } from "vue";

const props = defineProps({
    skills: {
        type: Array,
        default: () => [],
    },
});

// agrupar + transformar
const formattedSkills = computed(() => {
    const groups = {};

    props.skills.forEach((skill) => {
        const service = skill.service;

        if (!groups[service.id]) {
            groups[service.id] = {
                title: service.name,
                subtitle: service.description,
                icon: service.icon || "uil-server-network",
                items: [],
            };
        }

        groups[service.id].items.push({
            name: skill.name,
            percent: skill.proficiency + "%",
            value: skill.proficiency, // pra usar no width
        });
    });

    return Object.values(groups);
});

// controle abrir/fechar
const activeSkills = ref([0, 1, 2, 3]);

const toggleSkill = (index) => {
    if (activeSkills.value.includes(index)) {
        activeSkills.value = activeSkills.value.filter((i) => i !== index);
    } else {
        activeSkills.value.push(index);
    }
};

const leftSkills = computed(() => {
    return formattedSkills.value.slice(
        0,
        Math.ceil(formattedSkills.value.length / 2),
    );
});

const rightSkills = computed(() => {
    return formattedSkills.value.slice(
        Math.ceil(formattedSkills.value.length / 2),
    );
});
</script>

<template>
    <section class="skills section" id="skills">
        <h2 class="section__title">Skills</h2>
        <span class="section__subtitle">My technical level</span>
        <div class="skills_container container grid">
            <!-- COLUNA ESQUERDA -->
            <div>
                <div
                    v-for="(skill, index) in leftSkills"
                    :key="index"
                    :class="[
                        'skills_content',
                        activeSkills.includes(index)
                            ? 'skills_open'
                            : 'skills_close',
                    ]"
                >
                    <div class="skills_header" @click="toggleSkill(index)">
                        <i :class="['uil', skill.icon, 'skills_icon']"></i>

                        <div>
                            <h1 class="skills_title">{{ skill.title }}</h1>
                            <span class="skills_subtitle">{{
                                skill.subtitle
                            }}</span>
                        </div>

                        <i class="uil uil-angle-down skills_arrow"></i>
                    </div>

                    <div class="skills_list grid">
                        <div
                            class="skills_data"
                            v-for="item in skill.items"
                            :key="item.name"
                        >
                            <div class="skills_titles">
                                <h3 class="skills_name">{{ item.name }}</h3>
                                <span class="skills_number">{{
                                    item.percent
                                }}</span>
                            </div>
                            <div class="skills_bar">
                                <span
                                    :class="['skills_percentage', item.class]"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUNA DIREITA -->
            <div>
                <div
                    v-for="(skill, index) in rightSkills"
                    :key="index + 2"
                    :class="[
                        'skills_content',
                        activeSkills.includes(index + 2)
                            ? 'skills_open'
                            : 'skills_close',
                    ]"
                >
                    <div class="skills_header" @click="toggleSkill(index + 2)">
                        <i :class="['uil', skill.icon, 'skills_icon']"></i>

                        <div>
                            <h1 class="skills_title">{{ skill.title }}</h1>
                            <span class="skills_subtitle">{{
                                skill.subtitle
                            }}</span>
                        </div>

                        <i class="uil uil-angle-down skills_arrow"></i>
                    </div>

                    <div class="skills_list grid">
                        <div
                            class="skills_data"
                            v-for="item in skill.items"
                            :key="item.name"
                        >
                            <div class="skills_titles">
                                <h3 class="skills_name">{{ item.name }}</h3>
                                <span class="skills_number">{{
                                    item.percent
                                }}</span>
                            </div>
                            <div class="skills_bar">
                                <span
                                    :class="['skills_percentage', item.class]"
                                ></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.skills_container {
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.skills_close .skills_list {
    height: 0;
    overflow: hidden;
}

.skills_open .skills_list {
    height: auto;
    margin-top: 10px;
}
</style>
