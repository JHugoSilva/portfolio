import { onUnmounted, ref } from "vue";

export function useImagePreview() {
    const previewUrl = ref(null);

    const createPreview = (file) => {
        if (!file) return;

        // Limpa a URL anterior para evitar vazamento de memória
        if (previewUrl.value) {
            URL.revokeObjectURL(previewUrl.value);
        }

        // Cria uma URL temporária para o arquivo
        previewUrl.value = URL.createObjectURL(file);
    };

    // Importante: Limpar a memória quando o componente for destruído
    onUnmounted(() => {
        if (previewUrl.value) URL.revokeObjectURL(previewUrl.value);
    });

    return {
        previewUrl,
        createPreview,
    };
}
