import { createRouter, createWebHistory } from "vue-router";

import NotFoundPage from "../../components/pages/NotFoundPage.vue";
import AdminHomeIndex from "../../components/admin/home/Index.vue";
import AdminAboutEdit from "../../components/admin/abouts/Edit.vue";
import AdminMediasIndex from "../../components/admin/medias/Index.vue";
import AdminServicesIndex from "../../components/admin/services/Index.vue";
import AdminSkillsIndex from "../../components/admin/skills/Index.vue";
import AdminEducationsIndex from "../../components/admin/educations/Index.vue";
import AdminExperiencesIndex from "../../components/admin/experiences/Index.vue";
import AdminProjectsIndex from "../../components/admin/projects/Index.vue";
import AdminProjectsForm from "../../components/admin/projects/Form.vue";
import AdminTestimonialsIndex from "../../components/admin/testimonials/Index.vue";
import AdminTestimonialsForm from "../../components/admin/testimonials/Form.vue";
import AdminMessagesIndex from "../../components/admin/messages/Index.vue";
import AdminUsersIndex from "../../components/admin/users/Index.vue";

import LoginPage from "../../components/auth/Login.vue";
import api from "../../lib/Api";

const routes = [
    {
        path: "/admin",
        meta: { requiresAuth: true },
        children: [
            {
                path: "dashboard",
                name: "admin.home.index",
                component: AdminHomeIndex,
            },
            {
                path: "abouts",
                name: "admin.abouts",
                component: AdminAboutEdit,
            },
            {
                path: "medias",
                name: "admin.medias.index",
                component: AdminMediasIndex,
            },
            {
                path: "services",
                name: "admin.services.index",
                component: AdminServicesIndex,
            },
            {
                path: "skills",
                name: "admin.skills.index",
                component: AdminSkillsIndex,
            },
            {
                path: "educations",
                name: "admin.educations.index",
                component: AdminEducationsIndex,
            },
            {
                path: "experiences",
                name: "admin.experiences.index",
                component: AdminExperiencesIndex,
            },
            {
                path: "projects",
                name: "admin.projects.index",
                component: AdminProjectsIndex,
            },
            {
                path: "projects/create",
                name: "admin.projects.create",
                component: AdminProjectsForm,
            },
            {
                path: "projects/:id/edit",
                name: "admin.projects.edit",
                component: AdminProjectsForm,
            },
            {
                path: "testimonials",
                name: "admin.testimonials",
                component: AdminTestimonialsIndex,
            },
            {
                path: "testimonials/create",
                name: "admin.testimonials.create",
                component: AdminTestimonialsForm,
            },
            {
                path: "messages",
                name: "admin.messages.index",
                component: AdminMessagesIndex,
            },
            {
                path: "users",
                name: "admin.users.index",
                component: AdminUsersIndex,
            },
        ],
    },
    {
        path: "/admin/login",
        name: "admin.login",
        component: LoginPage,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "notFoundPage",
        component: NotFoundPage,
    },
];

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: "nav-active",
    routes,
});

export default router;

router.beforeEach(async (to, from) => {
    const token = localStorage.getItem("token");

    if (to.meta.requiresAuth) {
        if (!token) {
            return { name: "admin.login" };
        }

        try {
            await api.get(`/auth/profile/${token}`); // valida no backend
            return true;
        } catch {
            localStorage.removeItem("token");
            return { name: "admin.login" };
        }
    }

    return true;
});
