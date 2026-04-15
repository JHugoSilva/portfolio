import { createRouter, createWebHistory } from "vue-router";

import NotFoundPage from "../components/pages/NotFoundPage.vue";
import MainView from "../components/pages/home/components/MainView.vue";
import StudyPublication from "../components/pages/home/components/StudyPublication.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: MainView,
    },
    {
        path: "/study",
        name: "study",
        component: StudyPublication,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "notFoundPage",
        component: NotFoundPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    // linkActiveClass: "active-link", // Classe para rotas parciais
    linkExactActiveClass: "active-link",
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return new Promise((resolve) => {
                // Aguarda 500ms para garantir que o elemento foi renderizado
                setTimeout(() => {
                    resolve({
                        el: to.hash,
                        behavior: "smooth",
                    });
                }, 500);
            });
        }
        return { top: 0 };
    },
});

export default router;
