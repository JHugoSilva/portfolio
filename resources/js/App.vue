<script setup>
import { defineAsyncComponent, onMounted, provide } from "vue";
import { usePortfolio } from "@/composables/portfolio/usePortfolio";
import { portfolioKey } from "@/composables/portfolio/keys";

const portfolio = usePortfolio();

provide(portfolioKey, portfolio); // O objeto 'portfolio' contém as refs reativas

const MainLayout = defineAsyncComponent(
    () => import("./layouts/MainLayout.vue"),
);
const AppHeader = defineAsyncComponent(
    () => import("./components/pages/home/components/AppHeader.vue"),
);
const AppFooter = defineAsyncComponent(
    () => import("./components/pages/home/components/AppFooter.vue"),
);

onMounted(() => {
    portfolio.loadDataAll();
});
</script>
<template>
    <MainLayout>
        <template #header>
            <AppHeader />
        </template>
        <router-view />
        <template #footer>
            <AppFooter />
        </template>
    </MainLayout>
</template>
