import { ref } from "vue";

export function useProjectData(url) {
    const isLoading = ref(false);
    const error = ref(null);
    const success = ref(false);

    const insertData = async (payload) => {
        isLoading.value = true;
        error.value = null;
        success.value = false;

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    // "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: `Bearer ${localStorage.getItem("token")}`,
                },
                body: payload,
            });

            if (!response.ok) throw new Error("Erro ao inserir dados");

            success.value = true;
            return await response.json();
        } catch (error) {
            error.value = error.message;
        } finally {
            isLoading.value = false;
        }
    };

    return { insertData, isLoading, error, success };
}
