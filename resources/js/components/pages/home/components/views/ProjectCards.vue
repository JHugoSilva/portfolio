<script setup>
import { useRouter } from "vue-router";

const router = useRouter();
const loadView = () => {
    router.push({ name: "projects" }).then(() => {
        // Remove qualquer hash que tenha sobrado da home
        window.history.replaceState(window.history.state, "", "/projects");
        window.scrollTo(0, 0);
    });
};
</script>
<template>
    <!--==================== PROJECT IN MIND ====================-->
    <section class="project_section_full">
        <div class="project_full_card">
            <div class="project_container_full container">
                <div class="project_data_full">
                    <span class="project_subtitle">Destaque da Semana</span>
                    <h2 class="project_title_full">
                        Transforme suas ideias em realidade digital
                    </h2>
                    <p class="project_description_full">
                        Estamos prontos para elevar o nível do seu próximo
                        projeto com tecnologias de ponta e design focado na
                        conversão.
                    </p>
                    <div class="project_buttons">
                        <a href="#contact" class="button button--white"
                            >Falar Agora</a
                        >
                        <router-link to="/projects" class="button button--ghost"
                            >Ver Portfólio</router-link
                        >
                    </div>
                </div>

                <div class="project_img_wrapper">
                    <img
                        src="/public/template/assets/img/home2.png"
                        alt="Projeto em destaque"
                        class="project_img_full"
                    />
                </div>
            </div>

            <div class="bg_circle_1"></div>
            <div class="bg_circle_2"></div>
        </div>
    </section>
</template>
<style scoped>
/* Container Externo - Ocupa a largura total da tela */
.project_section_full {
    width: 100%;
    padding: 2rem 0;
}

.project_full_card {
    position: relative;
    background-color: #6e57e0;
    color: #fff;
    padding: 4rem 2rem;
    overflow: hidden;
    /* Caso queira que ele não encoste nas bordas laterais, use: border-radius: 2rem; */
}

/* Alinhamento Interno */
.project_container_full {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 3rem;
    max-width: 1200px; /* Limita o conteúdo, mas o fundo continua total */
    margin: 0 auto;
    position: relative;
    z-index: 5;
}

.project_data_full {
    flex: 1;
}

.project_subtitle {
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 2px;
    margin-bottom: 1rem;
    display: block;
    opacity: 0.8;
}

.project_title_full {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.project_description_full {
    font-size: 1.1rem;
    margin-bottom: 2.5rem;
    max-width: 500px;
    opacity: 0.9;
}

/* Botões */
.project_buttons {
    display: flex;
    gap: 1rem;
}

.button--white {
    background-color: #fff;
    color: #6e57e0;
    padding: 1rem 2rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: 0.3s;
}

.button--ghost {
    border: 2px solid rgba(255, 255, 255, 0.5);
    color: #fff;
    padding: 1rem 2rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: 0.3s;
}

.button--ghost:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-color: #fff;
}

/* Imagem e Decoração */
.project_img_full {
    width: 350px;
    filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.2));
    animation: float 4s ease-in-out infinite;
}

@keyframes float {
    0%,
    100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

/* Círculos Decorativos de Fundo */
.bg_circle_1,
.bg_circle_2 {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    z-index: 1;
}

.bg_circle_1 {
    width: 300px;
    height: 300px;
    top: -100px;
    right: -50px;
}
.bg_circle_2 {
    width: 150px;
    height: 150px;
    bottom: -50px;
    left: 10%;
}

/* Responsividade */
@media screen and (max-width: 992px) {
    .project_container_full {
        flex-direction: column;
        text-align: center;
    }
    .project_description_full {
        margin: 0 auto 2.5rem;
    }
    .project_buttons {
        justify-content: center;
    }
    .project_title_full {
        font-size: 2rem;
    }
}
</style>
