<script setup>
import { ref } from "vue";
defineProps(["educations", "experiences"]);
const activeTab = ref("work");

const tabs = [
    { id: "work", label: "Work", icon: "uil-briefcase-alt" },
    { id: "education", label: "Education", icon: "uil-graduation-cap" },
];

const qualifications = {
    education: [
        {
            title: "Computer Science",
            subtitle: "Germany - University",
            period: "2009 - 2014",
        },
        {
            title: "Web Design",
            subtitle: "Germany - Institute",
            period: "2014 - 2017",
        },
    ],
    work: [
        {
            title: "Software Engineer",
            subtitle: "Apple Inc - Germany",
            period: "2016 - 2018",
        },
        {
            title: "Frontend Developer",
            subtitle: "Apple Inc - Germany",
            period: "2018 - 2020",
        },
        {
            title: "UI Designer",
            subtitle: "Figma - Germany",
            period: "2017 - 2019",
        },
    ],
};

const setTab = (tab) => {
    activeTab.value = tab;
};
</script>

<template>
    <section class="qualification section">
        <h2 class="section__title">Qualification</h2>
        <span class="section__subtitle">My personal journey</span>
        {{ educations }} -> {{ experiences }}
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
