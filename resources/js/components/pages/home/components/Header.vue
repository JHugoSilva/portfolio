<script setup>
import { nextTick, onMounted, ref } from "vue";
import { useTheme } from "../../../../lib/useTheme";
import { useScroll } from "../../../../lib/useScroll";
const { activeSection, goToSection } = useScroll();
const { initTheme } = useTheme("theme-button");
const showMenu = ref(false);
const themeButton = ref(null); // ref para o botão
const toggleMenu = () => {
    showMenu.value = !showMenu.value;
};

const closeMenu = () => {
    showMenu.value = false;
};

onMounted(async () => {
    await nextTick();
    initTheme();
});
</script>
<template>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#home" class="nav_logo"> John Doe </a>
            <div class="nav_menu" id="nav-menu">
                <ul class="nav_list">
                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{ active_link: activeSection === 'home' }"
                            @click.prevent="goToSection('home')"
                        >
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{ active_link: activeSection === 'about' }"
                            @click.prevent="goToSection('about')"
                        >
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{ active_link: activeSection === 'skills' }"
                            @click.prevent="goToSection('skills')"
                        >
                            Skills
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{
                                active_link: activeSection === 'services',
                            }"
                            @click.prevent="goToSection('services')"
                        >
                            Services
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{
                                active_link: activeSection === 'portfolio',
                            }"
                            @click.prevent="goToSection('portfolio')"
                        >
                            Portfolio
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="#"
                            class="nav_link"
                            :class="{
                                active_link: activeSection === 'contact',
                            }"
                            @click.prevent="goToSection('contact')"
                        >
                            Contact Me
                        </a>
                    </li>
                </ul>
                <div class="nav_close" id="nav-close">
                    <i class="uil uil-times nav_close" id="nav-close"></i>
                </div>
            </div>

            <i class="uil uil-moon change-button" id="theme-button"></i>
            <div class="nav_btns">
                <!--===== THEME CHANGE BUTTON =====-->
                <div id="nav-toggle" @click="toggleMenu">☰</div>

                <!-- MENU -->
                <div class="nav_menu" :class="{ show_menu: showMenu }">
                    <!-- botão fechar -->
                    <div id="nav-close" @click="closeMenu">✖</div>

                    <ul class="nav_list">
                        <li>
                            <a href="#home" class="nav_link" @click="closeMenu">
                                Home
                            </a>
                        </li>
                        <li>
                            <a
                                href="#about"
                                class="nav_link"
                                @click="closeMenu"
                            >
                                Sobre
                            </a>
                        </li>
                        <li>
                            <a
                                href="#contact"
                                class="nav_link"
                                @click="closeMenu"
                            >
                                Contato
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>
<style scoped>
/* default = desktop */
.nav_btns {
    display: none;
}

/* mobile */
@media (max-width: 768px) {
    .nav_btns {
        display: flex;
    }
}

html {
    scroll-behavior: smooth;
}
.nav_link {
    background: none;
    border: none;
    outline: none;
    cursor: pointer;
    font: inherit; /* 🔥 herda fonte do site */
    text-align: left;
    color: var(--text-color);
    padding: 0; /* remove espaçamento padrão */
}
</style>
