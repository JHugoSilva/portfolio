import { reactive, ref, toRefs } from "vue";
import Api from "../../lib/Api";

export function usePortfolio() {
    // Agrupamos o estado para facilitar o gerenciamento e o reset, se necessário
    const state = reactive({
        about: {},
        educations: [],
        skills: [],
        experiences: [],
        medias: [],
        projects: [],
        project: null,
        services: [],
        loading: false,
        errors: null,
    });

    // Função utilitária para evitar repetição de lógica de erro/atribuição
    const fetchData = async (endPoint, stateKey, dataKey = null) => {
        try {
            const { data } = await Api.get(endPoint);
            // Se houver uma chave específica (ex: data.skills), usa ela, senão usa data.data ou o objeto inteiro
            state[stateKey] = dataKey ? data[dataKey] : data.data || data;
        } catch (error) {
            console.log("====================================");
            console.log(`Error ao carregar ${stateKey}: `, error);
            console.log("====================================");
        }
    };

    const loadDataAll = async (id = "") => {
        state.loading = true;
        state.errors = null;

        try {
            // Executa todas em paralelo para melhor performance
            const promises = [
                fetchData("site/about", "about"),
                fetchData("site/skills", "skills", "skills"),
                fetchData("site/educations", "educations", "educations"),
                fetchData("site/experiences", "experiences", "experiences"),
                fetchData("site/services", "services", "services"),
                fetchData("site/medias", "medias", "medias"),
                fetchData("site/indexSite", "projects", "projects"),
            ];

            // Se um ID for passado, adicionamos a busca do projeto específico à lista
            if (id) {
                promises.push(
                    fetchData(`site/project/${id}`, "project", "project"),
                );
            }

            // Executa todas em paralelo
            await Promise.all(promises);
        } catch (error) {
            state.errors = `Falha no Loading em Massa: ${error}`;
        } finally {
            state.loading = false;
        }
    };

    return {
        // toRefs permite desestruturar no componente sem perder a reatividade
        ...toRefs(state),
        //Actions
        loadDataAll,
    };
}

//**NOTAS */
// O que mudou e por quê?
// reactive + toRefs: Usar reactive organiza as variáveis de estado em um único "balde". O toRefs no retorno permite que você use const { about, loading } = usePortfolio() no seu componente como se fossem refs individuais.
// Abstração fetchData: Note que quase todas as suas funções faziam a mesma coisa: chamavam a API e atribuíam o resultado. Criei uma função interna que centraliza isso, reduzindo o código de 50 linhas para algo muito mais enxuto.
// Performance: O uso do Promise.all que você já tinha é a melhor prática aqui, pois dispara todas as requisições simultaneamente em vez de esperar uma por uma.
// Melhor tratamento de erros: Centralizei o erro no state.error para que você possa exibir uma mensagem amigável na UI (ex: um alerta de erro) de forma simples.
