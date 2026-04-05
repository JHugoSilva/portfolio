<script setup>
import { onMounted } from "vue";
import Swiper from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination, Autoplay } from "swiper/modules";

onMounted(() => {
    new Swiper(".portfolio_container", {
        modules: [Navigation, Pagination, Autoplay],
        loop: true,
        spaceBetween: 24,
        autoplay: {
            delay: 3000, // Tempo em ms entre cada slide (3 segundos)
            disableOnInteraction: false, // Continua passando mesmo após interação
        },
        speed: 1000,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
    });
});
</script>
<template>
    <!--==================== PORTFOLIO ====================-->
    <section class="portfolio section" id="portfolio">
        <h2 class="section__title">Portfolio</h2>
        <span class="section__subtitle">Most recent work</span>

        <div class="portfolio_container container swiper">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="portfolio_content grid swiper-slide">
                    <img
                        src="/public/template/assets/img/portfolio1.jpeg"
                        class="portfolio_img"
                    />

                    <div class="portfolio_data">
                        <h3 class="portfolio_title">Modern Website</h3>
                        <p class="portfolio_description">
                            Website adaptable to all devices, with UI and
                            animations.
                        </p>
                        <a
                            href="#"
                            class="button button--flex button--small portfolio_button"
                        >
                            Demo
                            <i class="uil uil-arrow-right button__icon"></i>
                        </a>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="portfolio_content grid swiper-slide">
                    <img
                        src="/public/template/assets/img/portfolio2.jpeg"
                        class="portfolio_img"
                    />

                    <div class="portfolio_data">
                        <h3 class="portfolio_title">POS App</h3>
                        <p class="portfolio_description">POS App description</p>
                        <a
                            href="#"
                            class="button button--flex button--small portfolio_button"
                        >
                            Demo
                            <i class="uil uil-arrow-right button__icon"></i>
                        </a>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="portfolio_content grid swiper-slide">
                    <img
                        src="/public/template/assets/img/portfolio3.jpeg"
                        class="portfolio_img"
                    />

                    <div class="portfolio_data">
                        <h3 class="portfolio_title">Online Store</h3>
                        <p class="portfolio_description">
                            Website adaptable with animations.
                        </p>
                        <a
                            href="#"
                            class="button button--flex button--small portfolio_button"
                        >
                            Demo
                            <i class="uil uil-arrow-right button__icon"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
</template>
<style scoped>
.portfolio_content {
    display: grid;
    grid-template-columns: 1fr 1fr; /* imagem | texto */
    align-items: center;
    gap: 2rem;
}

.portfolio_img {
    width: 100%;
    max-width: 300px;
    border-radius: 10px;
}
</style>
