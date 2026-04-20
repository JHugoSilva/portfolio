<script setup>
import { onMounted, provide } from "vue";

import MainLayout from "../layouts/MainLayout.vue";
import AppHeader from "./AppHeader.vue";
import AppFooter from "./AppFooter.vue";

import Publication from "./views/Publication.vue";

import { usePortfolio } from "@/composables/portfolio/usePortfolio";
import { portfolioKey } from "@/composables/portfolio/keys";

const portfolio = usePortfolio();

provide(portfolioKey, portfolio);

onMounted(() => {
    portfolio.loadAll();
});
</script>

<template>
    <MainLayout>
        <template #header>
            <AppHeader />
        </template>
        <!--==================== MAIN ====================-->
        <main class="main">
            <Publication />
        </main>
        <!--==================== SCROLL TOP ====================-->
        <a href="#" class="scrollup" id="scroll-up">
            <i class="uil uil-arrow-up scrollup_icon"></i>
        </a>
        <template #footer>
            <AppFooter />
        </template>
    </MainLayout>
</template>
