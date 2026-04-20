<script setup>
import { ref, computed, onMounted, watch } from "vue";

import { usePortfolioInject } from "@/composables/portfolio/usePortfolioInject";

const { skills } = usePortfolioInject();

// 1. Agrupamento e Formatação
const formattedSkills = computed(() => {
    // Tenta pegar a lista de skills.
    // Em objetos 'reactive', às vezes o .value não é necessário no JS.
    const rawSkills = skills.value || skills || [];

    // Se ainda assim não for uma array (ex: se for o RefImpl),
    // garantimos que pegamos a array.
    const skillsArray = Array.isArray(rawSkills) ? rawSkills : [];

    if (skillsArray.length === 0) return [];

    const groups = skillsArray.reduce((acc, skill) => {
        const s = skill.service;
        if (!s) return acc;

        if (!acc[s.id]) {
            acc[s.id] = {
                id: s.id,
                title: s.title,
                subtitle: s.category,
                icon: s.icon || "uil-brackets-curly",
                items: [],
            };
        }

        acc[s.id].items.push({
            name: skill.name,
            percent: skill.proficiency,
        });

        return acc;
    }, {});

    return Object.values(groups);
});

// 2. Controle de abas por ID (muito mais seguro que index)
const activeSkills = ref([]);

// Opcional: Iniciar com a primeira aba aberta
watch(
    formattedSkills,
    (newVal) => {
        if (newVal.length > 0 && activeSkills.value.length === 0) {
            activeSkills.value = newVal.map((s) => s.id);
        }
    },
    { immediate: true },
);

const toggleSkill = (id) => {
    const index = activeSkills.value.indexOf(id);
    if (index > -1) {
        activeSkills.value.splice(index, 1);
    } else {
        activeSkills.value.push(id);
    }
};

// 3. Divisão de Colunas
const columns = computed(() => {
    // 1. Forçamos data a ser uma array.
    // Se formattedSkills.value for nulo ou não for array, usamos []
    const data = Array.isArray(formattedSkills.value)
        ? formattedSkills.value
        : [];

    if (data.length === 0) return [[], []]; // Retorna duas colunas vazias por segurança

    const half = Math.ceil(data.length / 2);
    return [data.slice(0, half), data.slice(half)];
});
</script>

<template>
    <section class="skills section" id="skills">
        <h2 class="section__title">Habilidades</h2>
        <span class="section__subtitle">Meu nível técnico</span>
        <div class="skills_container container grid">
            <div v-for="(column, colIndex) in columns" :key="colIndex">
                <div
                    v-for="skill in column"
                    :key="skill.id"
                    :class="[
                        'skills_content',
                        activeSkills.includes(skill.id)
                            ? 'skills_open'
                            : 'skills_close',
                    ]"
                >
                    <div class="skills_header" @click="toggleSkill(skill.id)">
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
                            v-for="item in skill.items"
                            :key="item.name"
                            class="skills_data"
                        >
                            <div class="skills_titles">
                                <h3 class="skills_name">{{ item.name }}</h3>
                                <span class="skills_number"
                                    >{{ item.percent }}%</span
                                >
                            </div>
                            <div class="skills_bar">
                                <span
                                    class="skills_percentage"
                                    :style="{ width: item.percent + '%' }"
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
    align-items: start;
}

/* Animação de Abrir/Fechar */
.skills_list {
    transition: all 0.4s ease;
}

.skills_close .skills_list {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
}

.skills_open .skills_list {
    max-height: 1000px; /* Valor alto para permitir expansão */
    margin-top: 1.5rem;
    opacity: 1;
}

.skills_open .skills_arrow {
    transform: rotate(-180deg);
}

.skills_arrow {
    transition: 0.4s;
    margin-left: auto;
}

.skills_percentage {
    display: block;
    height: 5px;
    border-radius: 0.25rem;
    background-color: var(--first-color); /* Troquei o red pelo seu tema */
    transition: width 1.5s cubic-bezier(0.17, 0.67, 0.83, 0.67);
}

/* Responsividade para mobile */
@media screen and (max-width: 768px) {
    .skills_container {
        grid-template-columns: 1fr;
    }
}
</style>
