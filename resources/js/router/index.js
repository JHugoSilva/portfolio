import { createRouter, createWebHistory } from "vue-router";

import NotFoundPage from "../components/pages/NotFoundPage.vue";
import MainView from "../components/pages/home/components/MainView.vue";
import ProjectList from "../components/pages/home/components/views/ProjectsList.vue";
import PublicationView from "../components/pages/home/components/views/PublicationDetail.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: MainView,
    },
    {
        path: "/projects",
        name: "projects",
        component: ProjectList,
    },
    {
        path: "/project/:id",
        name: "ProjectDetails",
        component: PublicationView,
        props: true, // Permite que o ID seja passado como prop para a View
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
