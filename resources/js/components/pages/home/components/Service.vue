<script setup>
import { ref } from "vue";

const activeModal = ref(null);

const services = [
    {
        title: "UI/UX Designer",
        icon: "uil-web-grid",
        items: [
            "I develop the user interface",
            "Web page development",
            "I create UX interactions",
            "I position your company brand",
        ],
    },
    {
        title: "Frontend Developer",
        icon: "uil-arrow",
        items: [
            "Build responsive interfaces",
            "Consume APIs",
            "Improve performance",
            "Modern JS frameworks",
        ],
    },
    {
        title: "Backend Developer",
        icon: "uil-database",
        items: [
            "REST APIs with Laravel",
            "Database modeling",
            "Authentication & security",
            "System integrations",
        ],
    },
    {
        title: "Branding Designer",
        icon: "uil-pen",
        items: [
            "Brand identity",
            "Visual design",
            "UI consistency",
            "UX strategy",
        ],
    },
];

const openModal = (index) => (activeModal.value = index);
const closeModal = () => (activeModal.value = null);
</script>

<template>
    <section class="services section" id="services">
        <h2 class="section__title">Services</h2>
        <span class="section__subtitle">What I offer</span>

        <div class="services_container container grid">
            <div
                class="services_content"
                v-for="(service, index) in services"
                :key="index"
            >
                <!-- HEADER -->
                <div>
                    <i :class="['uil', service.icon, 'services_icon']"></i>
                    <h3 class="services_title">
                        {{ service.title }}
                    </h3>
                </div>

                <!-- BOTÃO -->
                <span
                    class="button button--flex button--small button--link services_button"
                    @click="openModal(index)"
                >
                    View More
                    <i class="uil uil-arrow-right button_icon"></i>
                </span>

                <!-- MODAL -->
                <div
                    class="services_modal"
                    :class="{ active_modal: activeModal === index }"
                >
                    <div class="services_modal-content">
                        <h4 class="services_modal-title">
                            {{ service.title }}
                        </h4>

                        <!-- FECHAR -->
                        <i
                            class="uil uil-times services_modal-close"
                            @click="closeModal"
                        ></i>

                        <ul class="services_modal-services grid">
                            <li
                                class="services_modal-service"
                                v-for="(item, i) in service.items"
                                :key="i"
                            >
                                <i
                                    class="uil uil-check-circle services_modal-icon"
                                ></i>
                                <p>{{ item }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.services_modal {
    opacity: 0;
    visibility: hidden;
    transition: 0.3s;
}

.services_modal.active_modal {
    opacity: 1;
    visibility: visible;
}
</style>
