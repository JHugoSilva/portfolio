<script setup>
defineProps(["about", "medias"]);
</script>

<template>
    <!--==================== INÍCIO ====================-->
    <section class="home section" id="home">
        <div class="home_container container grid">
            <div class="home_img">
                <img :src="about?.home_image" alt="Home Image" />
            </div>
            <!-- {{ about }} -->
            <div class="home_data">
                <h1 class="home_title">Olá, eu sou {{ about.name }}</h1>
                <h3 class="home_subtitle">{{ about.tagline }}</h3>
                <p class="home_description">
                    {{ about.description }}
                </p>
                <a href="#contact" class="button button--flex">
                    Fale comigo <i class="uil uil-message button__icon"></i>
                </a>

                <div class="home_scroll">
                    <a
                        href="#about"
                        class="home_scroll-button button--flex"
                    ></a>
                    <i class="uil uil-mouse-alt home_scroll-mouse"></i>
                    <span class="home_scroll-name">Role para baixo</span>
                    <i class="uil uil-arrow-down home_scroll-arrow"></i>
                </div>

                <div class="home_social">
                    <span class="home_social-follow">Siga-me</span>
                </div>

                <div class="home_scroll_social">
                    <div class="home_scroll1">
                        <a
                            href="#about"
                            class="home_scroll-button button--flex"
                        >
                            <i class="uil uil-mouse-alt home_scroll-mouse"></i>
                            <span class="home_scroll-name"
                                >Role para baixo</span
                            >
                            <i class="uil uil-arrow-down home_scroll-arrow"></i>
                        </a>
                    </div>
                    <!-- {{ medias }} -->
                    <div class="home_social1">
                        <div
                            class="home_social-links"
                            v-for="media in medias"
                            :key="media.id"
                        >
                            <a
                                :href="media.link"
                                target="_blank"
                                class="home_social-icon"
                            >
                                <i :class="`uil uil-${media.icon}`"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
