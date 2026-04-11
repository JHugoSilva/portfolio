<script setup>
defineProps(["about"]);
// Função para formatar (84999999999 -> (84) 99999-9999)
const formatPhone = (phone) => {
    if (!phone) return "";
    const p = phone.replace(/\D/g, ""); // Remove tudo que não é número

    if (p.length === 11) {
        return `(${p.slice(0, 2)}) ${p.slice(2, 7)}-${p.slice(7)}`;
    } else if (p.length === 10) {
        return `(${p.slice(0, 2)}) ${p.slice(2, 6)}-${p.slice(6)}`;
    }
    return phone; // Retorna original se não encaixar no padrão
};
</script>
<template>
    <!--==================== CONTACT ME ====================-->
    <section class="contact section" id="contact">
        <h2 class="section__title">Contact Me</h2>
        <span class="section__subtitle">Get in touch</span>

        <div class="contact_container container grid">
            <div>
                <div class="contact_information">
                    <a
                        :href="`https://wa.me/55${about.phone?.replace(/\D/g, '')}?text=${encodeURIComponent('Olá Hugo, vi seu portfólio e gostaria de conversar sobre um projeto!')}`"
                        target="_blank"
                        class="contact__container-link"
                    >
                        <i class="uil uil-whatsapp contact_icon"></i>

                        <div class="contact__texts">
                            <h3 class="contact_title">WhatsApp</h3>
                            <span class="contact_subtitle">{{
                                formatPhone(about.phone)
                            }}</span>
                        </div>
                    </a>
                </div>
                <div class="contact_information">
                    <i class="uil uil-envelope contact_icon"></i>

                    <div>
                        <h3 class="contact_title">Email</h3>
                        <span class="contact_subtitle">{{ about.email }}</span>
                    </div>
                </div>
                <div class="contact_information">
                    <i class="uil uil-map-marker contact_icon"></i>

                    <div>
                        <h3 class="contact_title">Location</h3>
                        <span class="contact_subtitle">{{
                            about.address
                        }}</span>
                    </div>
                </div>
            </div>

            <form action="" class="contact_form grid">
                <div class="contact_inputs grid">
                    <div class="contact_content">
                        <label for="" class="contact_label">Name</label>
                        <input type="text" class="contact_input" />
                    </div>
                    <div class="contact_content">
                        <label for="" class="contact_label">Email</label>
                        <input type="email" class="contact_input" />
                    </div>
                </div>
                <div class="contact_content">
                    <label for="" class="contact_label">Project</label>
                    <input type="tetx" class="contact_input" />
                </div>
                <div class="contact_content">
                    <label for="" class="contact_label"
                        >Project description</label
                    >
                    <textarea
                        name=""
                        id=""
                        cols="0"
                        rows="7"
                        class="contact_input"
                    ></textarea>
                </div>
                <div>
                    <a href="#" class="button button--flex">
                        Send Message
                        <i class="uil uil-message button_icon"></i>
                    </a>
                </div>
            </form>
        </div>
    </section>
</template>
<style scoped>
.contact__container-link:hover .uil-whatsapp {
    color: #25d366; /* Verde oficial do WhatsApp */
}

/* Container que envolve o link para garantir que ele não ocupe a largura total se não necessário */
.contact_information {
    margin-bottom: var(--mb-2);
}

/* O link principal configurado como Flexbox */
.contact__container-link {
    display: flex;
    align-items: center; /* Alinha o ícone verticalmente ao centro dos textos */
    column-gap: 1rem; /* Espaçamento entre o ícone e o bloco de texto */
    text-decoration: none;
    color: inherit;
    transition: 0.3s;
}

/* Agrupador de textos para ficarem um em cima do outro */
.contact__texts {
    display: flex;
    flex-direction: column;
    row-gap: 0.25rem; /* Espaço entre "WhatsApp" e o número */
}

/* Ajuste fino nos títulos para evitar que margens padrão quebrem o alinhamento */
.contact_title {
    font-size: var(--h3-font-size);
    font-weight: var(--font-medium);
    margin: 0;
    line-height: 1.2;
}

.contact_subtitle {
    font-size: var(--small-font-size);
    color: var(--text-color-light);
}

/* Efeito Hover profissional */
.contact__container-link:hover {
    transform: translateX(5px); /* Leve deslocamento lateral */
}

.contact__container-link:hover .contact_icon {
    color: #25d366; /* Cor verde do WhatsApp no hover */
}
</style>
