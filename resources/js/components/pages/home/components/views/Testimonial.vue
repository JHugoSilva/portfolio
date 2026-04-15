<script setup>
import Swiper from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import { Navigation, Pagination, Autoplay } from "swiper/modules";
import { onMounted } from "vue";

onMounted(() => {
    new Swiper(".testimonial_container", {
        modules: [Pagination, Autoplay],
        loop: true, // loop infinito
        spaceBetween: 24, // espaço entre slides
        speed: 1000, // velocidade da transição (suave)
        grabCursor: true,
        autoplay: {
            delay: 3000, // tempo entre slides
            disableOnInteraction: false, // continua autoplay mesmo após interação
        },
        pagination: {
            el: ".swiper-pagination-testimonial",
            clickable: true, // permite clicar na paginação
        },
    });
});
</script>
<template>
    <!--==================== TESTIMONIAL ====================-->
    <section class="testimonial section">
        <h2 class="section__title">Testimonial</h2>
        <span class="section__subtitle">My client saying</span>

        <div class="testimonial_container container swiper">
            <div class="swiper-wrapper">
                <!--========= TESTIMONIAL 1 ==========-->
                <div class="testimonial_content swiper-slide">
                    <div class="testimonial_data">
                        <div class="testimonial_header">
                            <img
                                src="/public/template/assets/img/testimonial1.jpeg"
                                alt=""
                                class="testimonial_img"
                            />

                            <div>
                                <h3 class="testimonial_name">Jay Smith</h3>
                                <span class="testimonial_client">Client</span>
                            </div>
                        </div>

                        <div>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                        </div>
                    </div>
                    <p class="testimonial_description">
                        I get a good impression,I carry out my project with all
                        the possible quality and attention and support 24 hours
                        a day.
                    </p>
                </div>
                <!--========= TESTIMONIAL 2 ==========-->
                <div class="testimonial_content swiper-slide">
                    <div class="testimonial_data">
                        <div class="testimonial_header">
                            <img
                                src="/public/template/assets/img/testimonial2.jpg"
                                alt=""
                                class="testimonial_img"
                            />

                            <div>
                                <h3 class="testimonial_name">John Smith</h3>
                                <span class="testimonial_client">Client</span>
                            </div>
                        </div>

                        <div>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                        </div>
                    </div>
                    <p class="testimonial_description">
                        I get a good impression,I carry out my project with all
                        the possible quality and attention and support 24 hours
                        a day.
                    </p>
                </div>
                <!--========= TESTIMONIAL 3 ==========-->
                <div class="testimonial_content swiper-slide">
                    <div class="testimonial_data">
                        <div class="testimonial_header">
                            <img
                                src="/public/template/assets/img/testimonial3.jpeg"
                                alt=""
                                class="testimonial_img"
                            />

                            <div>
                                <h3 class="testimonial_name">Mike Smith</h3>
                                <span class="testimonial_client">Client</span>
                            </div>
                        </div>

                        <div>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                            <i class="uil uil-star testimonial_icon-star"></i>
                        </div>
                    </div>
                    <p class="testimonial_description">
                        I get a good impression,I carry out my project with all
                        the possible quality and attention and support 24 hours
                        a day.
                    </p>
                </div>
            </div>
            <!--Add Pagination-->
            <div class="swiper-pagination swiper-pagination-testimonial"></div>
        </div>
    </section>
</template>
