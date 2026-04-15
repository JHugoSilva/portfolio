import { ref } from "vue";
import api from "../../lib/Api";

export function usePortfolio() {
    const about = ref({});
    const skills = ref([]);
    const educations = ref({});
    const experiences = ref([]);
    const medias = ref({});
    const services = ref({});

    const loading = ref(false);
    const error = ref(null);

    const getAbout = async () => {
        await api.get("site/about").then((response) => {
            about.value = response.data.data;
        });
    };

    const getSkills = async () => {
        await api.get("site/skills").then((response) => {
            skills.value = response.data.skills;
        });
    };

    const getEducations = async () => {
        await api.get("site/educations").then((response) => {
            educations.value = response.data.educations;
        });
    };

    const getExperiences = async () => {
        await api.get("site/experiences").then((response) => {
            experiences.value = response.data.experiences;
        });
    };

    const getMedias = async () => {
        await api.get("site/medias").then((response) => {
            medias.value = response.data.medias;
        });
    };

    const getServices = async () => {
        await api.get("site/services").then((response) => {
            services.value = response.data.services;
        });
    };

    const loadAll = async () => {
        try {
            loading.value = true;
            error.value = null;

            await Promise.all([
                getAbout(),
                getSkills(),
                getEducations(),
                getExperiences(),
                getMedias(),
                getServices(),
            ]);
        } catch (error) {
            error.value = error;
            console.log(`Error ao carregar Portfolio: ${error}`);
        } finally {
            loading.value = false;
        }
    };

    return {
        //State
        about,
        skills,
        educations,
        experiences,
        medias,
        services,
        loading,
        error,

        //Actions
        loadAll,
    };
}
