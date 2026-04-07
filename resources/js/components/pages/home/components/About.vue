<script setup>
defineProps(["about"]);
const getHomeImage = (img) => {
    if (img) {
        return "/upload/" + img;
    } else {
        return "/template/assets/img/avatar.jpg";
    }
};
const getCvDownload = (cv) => {
    if (cv) {
        return "/upload/" + cv;
    } else {
        return null;
    }
};
</script>
<template>
    <!--==================== ABOUT ====================-->
    <section class="about section" id="about">
        <h2 class="section__title">About Me</h2>
        <span class="section__subtitle">My introduction</span>

        <div class="about_container container grid">
            <div class="banner_img">
                <img :src="about?.banner_image" alt="Banner Image" />
            </div>
            <div class="about_data">
                <p class="about_description" v-if="about && about.summary">
                    {{ about.summary }}
                </p>
                <div class="about_info">
                    <div>
                        <span class="about_info-title">08+</span>
                        <span class="about_info-name"
                            >Years <br />experience</span
                        >
                    </div>
                    <div>
                        <span class="about_info-title">25+</span>
                        <span class="about_info-name"
                            >Completed <br />project</span
                        >
                    </div>
                    <div>
                        <span class="about_info-title">04+</span>
                        <span class="about_info-name"
                            >Companies <br />worked</span
                        >
                    </div>
                </div>
                <div class="about_buttons">
                    <a
                        v-if="getCvDownload(about.cv)"
                        :href="getCvDownload(about.cv)"
                        class="button button--flex"
                        download
                    >
                        Download CV
                        <i class="uil uil-download-alt button_icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>
