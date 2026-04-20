<script setup>
import { nextTick, onMounted, onUnmounted, ref } from "vue";
import { useTheme } from "@/lib/useTheme";
const { initTheme, toggleTheme } = useTheme("theme-button");

const activeSection = ref("home");
const showMenu = ref(false);
const isVisible = ref(false);

import { usePortfolioInject } from "@/composables/portfolio/usePortfolioInject";

const { about } = usePortfolioInject();

const toggleMenu = () => {
    console.log("Clique detetado! Estado anterior:", showMenu.value);
    showMenu.value = !showMenu.value;
    console.log("Estado atual:", showMenu.value);
};

const closeMenu = () => {
    console.log("Fechando...");
    showMenu.value = false;
};

// Função para detectar qual seção está visível
const handleAllScrolls = () => {
    const scrollY = window.pageYOffset;

    // 1. Lógica do Scroll Up (Botão flutuante)
    isVisible.value = scrollY >= 560;

    // 2. Lógica de Scroll Active (Menu dinâmico)
    const sections = document.querySelectorAll("section[id]");
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
    // Aguarda o DOM renderizar completamente
    await nextTick();
    // Inicializa o tema (se houver essa função)
    if (typeof initTheme === "function") initTheme();

    // Registra um único event listener para ambos
    window.addEventListener("scroll", handleAllScrolls);

    // Executa uma vez no início para definir o estado inicial
    handleAllScrolls();
});

onUnmounted(() => {
    // Limpa o listener ao destruir o componente
    window.removeEventListener("scroll", handleAllScrolls);
});

const navLinks = [
    { name: "Início", hash: "#home", icon: "estate" },
    { name: "Sobre", hash: "#about", icon: "user" },
    { name: "Habilidades", hash: "#skills", icon: "file-alt" },
    { name: "Serviços", hash: "#services", icon: "briefcase-alt" },
    { name: "Qualificações", hash: "#qualification", icon: "graduation-cap" },
    { name: "Contato", hash: "#contact", icon: "scenery" },
];
</script>
<template>
    <header class="header" id="header">
        <nav class="nav container">
            <router-link :to="{ name: 'home' }" class="nav_logo">
                {{ about.name }}
            </router-link>

            <div
                class="nav_menu"
                :class="{ 'show-menu': showMenu }"
                id="nav-menu"
            >
                <ul class="nav_list grid">
                    <li v-for="link in navLinks" :key="link.hash">
                        <a
                            :href="link.hash"
                            @click="closeMenu"
                            :class="[
                                'nav_link',
                                {
                                    'active-link':
                                        activeSection ===
                                        link.hash.replace('#', ''),
                                },
                            ]"
                        >
                            <i :class="`uil uil-${link.icon} nav_icon`"></i>
                            {{ link.name }}
                        </a>
                    </li>
                    <div>
                        <i
                            class="uil uil-moon change-theme"
                            @click="toggleTheme"
                            style="cursor: pointer"
                        ></i>
                    </div>
                </ul>
                <i
                    class="uil uil-times nav_close"
                    id="nav_close"
                    @click="closeMenu"
                ></i>
            </div>

            <div class="nav_btns">
                <i
                    class="uil uil-moon change-theme"
                    @click="toggleTheme"
                    style="cursor: pointer"
                ></i>

                <div class="nav_toggle" id="nav-toggle" @click="toggleMenu">
                    <i class="uil uil-bars"></i>
                </div>
            </div>
            <!-- <button
                @click="toggleMenu"
                style="position: fixed; top: 10px; left: 10px; z-index: 9999"
            >
                DEBUG MENU: {{ showMenu }}
            </button> -->
        </nav>
    </header>

    <a
        href="#"
        :class="['scrollup', { 'show-scroll': isVisible }]"
        id="scroll-up"
    >
        <i class="uil uil-arrow-up scrollup_icon"></i>
    </a>
</template>
<style scoped>
/* default = desktop */
.nav_btns {
    display: none;
}

.nav_icon {
    display: inline-block;
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

/* Estado Base: Escondido */
.scrollup {
    position: fixed;
    right: 1rem;
    bottom: -20%; /* Começa fora da tela */
    background-color: var(
        --first-color
    ); /* Certifique-se que essa variável existe */
    opacity: 0.8;
    padding: 0.9rem;
    border-radius: 0.4rem;
    z-index: var(--z-tooltip); /* Garanta que seja alto, ex: 100 */
    transition: 0.4s;
    border-radius: 50%;
}

.scrollup:hover {
    background-color: var(--first-color-alt);
    opacity: 1;
}

.scrollup_icon {
    font-size: 1.5rem;
    color: #fff;
}

/* Estado Ativo: Visível */
.show-scroll {
    bottom: 5rem; /* Sobe para aparecer na tela */
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

/* Mobile */
@media screen and (max-width: 767px) {
    .nav_btns {
        display: flex;
    }

    div#nav-menu.nav_menu {
        position: fixed;
        left: 0;
        width: 100%;
        height: 100%;
        transform: translateY(100%);
        transition: transform 0.3s;
    }

    div#nav-menu.nav_menu.show-menu {
        transform: translateY(0);
    }
}
</style>
