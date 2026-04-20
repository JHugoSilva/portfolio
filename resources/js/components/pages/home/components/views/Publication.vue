<template>
    <section class="services section" id="services">
        <h2 class="section__title">Meus Projetos</h2>
        <span class="section__subtitle">Algumas de minhas habilidades</span>
        <div class="services_container container grid">
            <div class="services_content">
                <!-- HEADER -->
                <div>
                    <i class="uil uil-web-grid services_icon"></i>
                    <h3 class="services_title">Título</h3>
                </div>

                <!-- BOTÃO -->
                <span
                    class="button button--flex button--small button--link services_button"
                >
                    Ver Mais
                    <i class="uil uil-arrow-right button_icon"></i>
                </span>
                <router-link
                    :to="{
                        name: 'ProjectDetails',
                        params: { id: 1 },
                    }"
                    class="button button--flex button--small"
                >
                    Ver Detalhes
                    <i class="uil uil-arrow-right button__icon"></i>
                </router-link>
            </div>
        </div>
    </section>
</template>
