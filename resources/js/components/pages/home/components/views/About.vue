<script setup>
import { usePortfolioInject } from "../../../../../composables/portfolio/usePortfolioInject";

const { about } = usePortfolioInject();
</script>
<template>
    <!--==================== ABOUT ====================-->
    <section class="about section" id="about">
        <h2 class="section__title">About Me</h2>
        <span class="section__subtitle">My introduction</span>

        <div class="about_container container grid">
            <!-- {{ about }} -->
            <div class="setting-avatar">
                <img
                    :src="about?.banner_image"
                    alt="Banner Image"
                    class="about_img"
                />
            </div>
            <div class="about_data">
                <p class="about_description" v-if="about && about.summary">
                    {{ about.summary }}
                </p>
                <div class="about_info">
                    <div>
                        <span class="about_info-title">08+</span>
                        <span class="about_info-name">
                            Anos de <br />experiência
                        </span>
                    </div>
                    <div>
                        <span class="about_info-title">12+</span>
                        <span class="about_info-name"
                            >Projetos <br />completos</span
                        >
                    </div>
                    <div>
                        <span class="about_info-title">04+</span>
                        <span class="about_info-name">
                            Empresas <br />onde trabalhei
                        </span>
                    </div>
                </div>
                <div class="about_buttons">
                    <a :href="about.cv" class="button button--flex" download>
                        Download CV
                        <i class="uil uil-download-alt button_icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
