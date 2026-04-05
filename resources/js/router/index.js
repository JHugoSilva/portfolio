import { createRouter, createWebHistory } from "vue-router";

import NotFoundPage from "../components/pages/NotFoundPage.vue";
import Main from "../components/pages/home/components/Main.vue";

const routes = [
    {
        path: "/",
        name: "home",
        component: Main,
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
});

export default router;
