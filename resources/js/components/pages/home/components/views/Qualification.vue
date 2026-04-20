<script setup>
import { computed, ref } from "vue";
const activeTab = ref("work");

import { usePortfolioInject } from "@/composables/portfolio/usePortfolioInject";

const { educations, experiences } = usePortfolioInject();

const tabs = [
    { id: "work", label: "Trabalhos", icon: "uil-briefcase-alt" },
    { id: "education", label: "Educação", icon: "uil-graduation-cap" },
];

const qualifications = computed(() => {
    return {
        education:
            educations?.value.map((edu) => ({
                title: edu.institution,
                subtitle: edu.degree,
                period: `Período: ${edu.start_date} - ${edu.end_date ?? "Atual"}`,
            })) || [],
        work:
            experiences?.value.map((exp) => ({
                title: exp.role,
                subtitle: exp.company,
                period: `Período: ${exp.start_date} - ${exp.end_date ?? "Atual"}`,
            })) || [],
    };
});

const setTab = (tab) => {
    activeTab.value = tab;
};
</script>

<template>
    <section class="qualification section">
        <h2 class="section__title">Qualificação</h2>
        <span class="section__subtitle">Minha jornada pessoal</span>

        <div class="qualification_container container">
            <!-- TABS -->
            <div class="qualification_tabs">
                <div
                    v-for="tab in tabs"
                    :key="tab.id"
                    @click="setTab(tab.id)"
                    :class="[
                        'qualification_button button--flex',
                        activeTab === tab.id && 'qualification_active',
                    ]"
                >
                    <i :class="['uil', tab.icon, 'qualification_icon']"></i>
                    {{ tab.label }}
                </div>
            </div>

            <!-- CONTENT -->
            <div class="qualification_sections">
                <div class="qualification_content qualification_active">
                    <div
                        v-for="(item, index) in qualifications[activeTab]"
                        :key="index"
                        class="qualification_data"
                    >
                        <!-- alterna esquerda/direita -->
                        <template v-if="index % 2 === 0">
                            <div>
                                <h3 class="qualification_title">
                                    {{ item.title }}
                                </h3>
                                <span class="qualification_subtitle">{{
                                    item.subtitle
                                }}</span>
                                <div class="qualification_calendar">
                                    <i class="uil uil-calender-alt"></i>
                                    {{ item.period }}
                                </div>
                            </div>
                            <div>
                                <span class="qualification_rounder"></span>
                                <span
                                    class="qualification_line"
                                    v-if="
                                        index !==
                                        qualifications[activeTab].length - 1
                                    "
                                ></span>
                            </div>
                        </template>

                        <template v-else>
                            <div></div>
                            <div>
                                <span class="qualification_rounder"></span>
                                <span
                                    class="qualification_line"
                                    v-if="
                                        index !==
                                        qualifications[activeTab].length - 1
                                    "
                                ></span>
                            </div>
                            <div>
                                <h3 class="qualification_title">
                                    {{ item.title }}
                                </h3>
                                <span class="qualification_subtitle">{{
                                    item.subtitle
                                }}</span>
                                <div class="qualification_calendar">
                                    <i class="uil uil-calender-alt"></i>
                                    {{ item.period }}
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
