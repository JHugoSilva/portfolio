<script setup>
import { usePortfolioInject } from "@/composables/portfolio/usePortfolioInject";

const { about } = usePortfolioInject();
import { useVuelidate } from "@vuelidate/core";
import { required, email } from "@vuelidate/validators";
import { reactive, ref } from "vue";
import BaseInput from "../../../../bases/BaseInput.vue";
import Api from "../../../../../lib/Api";
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

const loading = ref(false);

// 1. Estado dos dados do formulário
const formData = reactive({
    nome: "",
    email: "",
    telefone: "",
    projeto: "",
    descricao: "",
});

// 2. Regras de validação
const rules = {
    nome: { required },
    email: { required, email },
    assunto: { required },
    mensagem: { required },
};

const v$ = useVuelidate(rules, formData);

// 3. Função de envio
const submitForm = async () => {
    const result = await v$.value.$validate();

    if (!result) return;
    try {
        loading.value = true;
        const response = await Api.post("/site/contato", formData);

        // Limpa o formulário após o sucesso
        Object.assign(formData, {
            nome: "",
            email: "",
            telefone: "",
            assunto: "",
            mensagem: "",
        });
        v$.value.$reset();

        alert("Mensagem enviada com sucesso!");
    } catch (error) {
        console.error("Erro ao enviar:", error);
        alert("Ocorreu um erro ao enviar a mensagem.");
    } finally {
        loading.value = false;
    }
};
</script>
<template>
    <!--==================== CONTACT ME ====================-->
    <section class="contact section" id="contact">
        <h2 class="section__title">Entre em contato comigo</h2>
        <span class="section__subtitle">Fale comigo </span>

        <div class="contact_container container grid">
            <div>
                <div class="contact_information">
                    <a
                        :href="`https://wa.me/55${about.phone?.replace(/\D/g, '')}?text=${encodeURIComponent('Olá Hugo, vi seu portfólio e gostaria de conversar sobre um projeto!')}`"
                        target="_blank"
                        class="contact__container-link"
                    >
                        <i class="uil uil-whatsapp contact_icon"></i>

                        <div>
                            <h3 class="contact_title">WhatsApp</h3>
                            <span class="contact_subtitle">{{
                                formatPhone(about.phone)
                            }}</span>
                        </div>
                    </a>
                </div>
                <div class="contact_information">
                    <div>
                        <a
                            class="contact__container-link"
                            :href="`mailto:${about.email}`"
                        >
                            <i class="uil uil-envelope contact_icon"></i>
                            <div>
                                <h3 class="contact_title">Email</h3>
                                <span class="contact_subtitle">
                                    {{ about.email }}
                                </span>
                            </div>
                        </a>
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

            <form @submit.prevent="submitForm" class="contact_form grid">
                <div class="contact_inputs grid">
                    <BaseInput
                        label="Nome"
                        v-model="formData.nome"
                        :hasError="v$.nome.$error"
                        errorMessage="Nome é obrigatório"
                    />

                    <BaseInput
                        label="Email"
                        v-model="formData.email"
                        :hasError="v$.email.$error"
                        errorMessage="Email é obrigatório"
                    />

                    <BaseInput label="Telefone" v-model="formData.telefone" />

                    <BaseInput
                        label="Projeto"
                        v-model="formData.assunto"
                        :hasError="v$.assunto.$error"
                        errorMessage="Título do projeto é obrigatório"
                    />

                    <BaseInput
                        type="textarea"
                        label="Descrição do projeto"
                        v-model="formData.mensagem"
                        :hasError="v$.mensagem.$error"
                        errorMessage="Descrição do projeto é obrigatório"
                    />
                    <div>
                        <button
                            type="submit"
                            class="button button--flex"
                            style="border: none"
                        >
                            Send Message
                            <i class="uil uil-message button_icon"></i>
                        </button>
                    </div>
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
    column-gap: 0.2rem; /* Espaçamento entre o ícone e o bloco de texto */
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
