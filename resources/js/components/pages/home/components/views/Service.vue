<script setup>
import { ref } from "vue";

import { usePortfolioInject } from "../../../../../composables/portfolio/usePortfolioInject";
const { services } = usePortfolioInject();

const activeModal = ref(null);
const openModal = (index) => (activeModal.value = index);
const closeModal = () => (activeModal.value = null);
</script>

<template>
    <section class="services section" id="services">
        <h2 class="section__title">Serviços</h2>
        <span class="section__subtitle">O que eu ofereço</span>
        <div class="services_container container grid">
            <div
                class="services_content"
                v-for="(service, index) in services"
                :key="index"
            >
                <!-- HEADER -->
                <div>
                    <i class="uil uil-web-grid services_icon"></i>
                    <h3 class="services_title">
                        {{ service.title }}
                    </h3>
                </div>

                <!-- BOTÃO -->
                <span
                    class="button button--flex button--small button--link services_button"
                    @click="openModal(index)"
                >
                    Ver Mais
                    <i class="uil uil-arrow-right button_icon"></i>
                </span>

                <!-- MODAL -->
                <div
                    class="services_modal"
                    :class="{ active_modal: activeModal === index }"
                >
                    <div class="services_modal-content">
                        <h4 class="services_modal-title">
                            {{ service.category }}
                        </h4>

                        <!-- FECHAR -->
                        <i
                            class="uil uil-times services_modal-close"
                            @click="closeModal"
                        ></i>
                        <ul class="services_modal-services grid">
                            <li class="services_modal-service">
                                <i
                                    class="uil uil-check-circle services_modal-icon"
                                ></i>
                                <p>{{ service.description }}</p>
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
