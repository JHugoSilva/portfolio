<script setup>
import { nextTick, onMounted, onUnmounted, ref } from "vue";
import { useTheme } from "../../../../lib/useTheme";
const { initTheme } = useTheme("theme-button");

const activeSection = ref("home");
const showMenu = ref(false);

import { usePortfolioInject } from "../../../../composables/portfolio/usePortfolioInject";

const { about } = usePortfolioInject();

const toggleMenu = () => (showMenu.value = !showMenu.value);
const closeMenu = () => (showMenu.value = false);

// Função para detectar qual seção está visível
const scrollActive = () => {
    const sections = document.querySelectorAll("section[id]");
    const scrollY = window.pageYOffset;

    sections.forEach((current) => {
        const sectionHeight = current.offsetHeight;
        const sectionTop = current.offsetTop - 150; // Offset para detectar antes de chegar no topo
        const sectionId = current.getAttribute("id");

        if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
            activeSection.value = sectionId;
        }
    });
};

onMounted(async () => {
    await nextTick();
    initTheme();

    window.addEventListener("scroll", scrollActive);
});

onUnmounted(() => {
    window.removeEventListener("scroll", scrollActive);
});
</script>
<template>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <router-link :to="{ name: 'home', hash: '#home' }" class="nav_logo">
                {{ about.name }}
            </router-link>

            <div
                class="nav_menu"
                :class="{ 'show-menu': showMenu }"
                id="nav-menu"
            >
                <ul class="nav_list grid">
                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#home' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'home',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-estate nav_icon"></i> Home
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#about' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'about',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-user nav_icon"></i> About
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#skills' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'skills',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-file-alt nav_icon"></i> Skills
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#services' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'services',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-briefcase-alt nav_icon"></i>
                            Services
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#portfolio' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'portfolio',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-scenery nav_icon"></i> Portfolio
                        </router-link>
                    </li>

                    <li class="nav-item">
                        <router-link
                            :to="{ name: 'home', hash: '#contact' }"
                            class="link"
                            :class="{
                                nav_link: activeSection === 'contact',
                            }"
                            @click="closeMenu"
                        >
                            <i class="uil uil-message nav_icon"></i> Contact
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <i
                            class="uil uil-moon change-theme"
                            id="theme-button"
                            ref="themeButton"
                            style="cursor: pointer"
                            @click="toggleTheme"
                        ></i>
                    </li>
                </ul>
                <i
                    class="uil uil-times nav_close"
                    id="nav-close"
                    @click="closeMenu"
                ></i>
            </div>

            <div class="nav_btns">
                <i class="uil uil-moon change-theme" id="theme-button"></i>
                <div class="nav_toggle" id="nav-toggle" @click="toggleMenu">
                    <i class="uil uil-apps"></i>
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

.link {
    color: var(--title-color);
}
/* Estilo base do link */
.nav_link {
    position: relative; /* Necessário para posicionar a barra em relação ao link */
    color: var(--text-color); /* Ou a cor padrão do seu menu */
    transition: color 0.3s;
    padding: 0.5rem 0; /* Espaçamento interno para não colar na barra */
}

/* Cor do link quando estiver ativo */
.nav_link.active-link {
    color: var(--first-color);
}

/* Criação da barra abaixo do link ativo */
.nav_link.active-link::after {
    content: "";
    position: absolute;
    bottom: -2px; /* Ajuste para descer ou subir a barra */
    left: 0;
    width: 100%;
    height: 3px; /* Espessura da barra */
    background-color: var(--first-color);
    border-radius: 10px; /* Deixa as pontas da barra arredondadas */

    /* Opcional: Animação suave ao trocar de link */
    animation: slideIn 0.3s ease-out;
}

/* Pequena animação de entrada */
@keyframes slideIn {
    from {
        transform: scaleX(0);
        opacity: 0;
    }
    to {
        transform: scaleX(1);
        opacity: 1;
    }
}
</style>
