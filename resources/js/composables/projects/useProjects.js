import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import api from "../../lib/Api";

export function useProject() {
    const router = useRouter();
    const route = useRoute();

    const errors = ref([]);
    const editMode = ref(false);
    const loading = ref(false);
    const projectValue = ref([]);

    const form = ref({
        id: null,
        title: "",
        category: "",
        date: "",
        videoUrl: "",
        projectLink: "",
        longDescription: "",
        image: null,
    });

    const getProject = async () => {
        if (!route.params.id) return;

        loading.value = true;
        try {
            const { data } = await api.get(`/v1/projects/${route.params.id}`);

            projectValue.value = data.project;

            // Mapeamento dos dados vindo da API para o form
            // form.value.id = project?.id || "";
            // form.value.title = project?.title || "";
            // form.value.category = project?.category || "";
            // form.value.date = project?.date || "";
            // form.value.videoUrl = project?.videoUrl || "";
            // form.value.projectLink = project?.projectLink || "";
            // form.value.longDescription = project?.longDescription || "";
            // form.value.image = project?.image || null;
        } catch (error) {
            console.error("Erro ao carregar projeto:", error);
        } finally {
            loading.value = false;
        }
    };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        form.value.image = file;
        console.log("Estado atual da imagem:", form.value.image);
        const reader = new FileReader();
        reader.onload = () => {
            const output = document.getElementById("projects-img");
            if (output) output.src = reader.result;
        };
        reader.readAsDataURL(file);
    };

    const getImagePreview = () => {
        const image = form.value.image;

        // 1. Se não houver imagem nenhuma
        if (!form.value.image) {
            return "/template/assets/img/no-image.png";
        }

        // 2. Se a imagem for um objeto File (usuário acabou de selecionar um arquivo)
        if (form.value.image instanceof File) {
            return URL.createObjectURL(form.value.image);
        }

        // 3. Se a imagem for uma string (veio do backend/banco de dados)
        if (typeof form.value.image === "string") {
            return "/upload/" + form.value.image;
        }

        return "/template/assets/img/no-image.png";
    };

    const persistData = async () => {
        const formData = new FormData();
        // Append dinâmico para evitar repetição
        Object.keys(form.value).forEach((key) => {
            if (form.value[key] !== null) {
                formData.append(key, form.value[key]);
            }
        });

        const url = editMode.value
            ? `/v1/projects/${route.params.id}`
            : "/v1/projects";

        try {
            await api.post(url, formData);
            router.push("/admin/projects");
            // Nota: Certifique-se que o 'toast' está disponível globalmente ou importe-o aqui
            toast.fire({
                icon: "success",
                title: editMode.value ? "Project Updated!" : "Project Added!",
            });
        } catch (error) {
            if (error.response?.status === 422) {
                errors.value = error.response.data.errors;
            }
        }
    };

    onMounted(() => {
        if (route.name === "admin.projects.edit") {
            editMode.value = true;
            getProject();
        }
    });

    return {
        form,
        errors,
        editMode,
        loading,
        projectValue,
        handleFileChange,
        getImagePreview,
        persistData,
        getProject,
    };
}
