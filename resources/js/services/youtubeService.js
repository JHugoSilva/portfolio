export const getYoutubeMetaData = async (videoUrl) => {
    try {
        // Monta a URL de consulta ao oEmbed do YouTube
        const fetchUrl = `https://www.youtube.com/oembed?url=${encodeURIComponent(videoUrl)}&format=json`;

        const response = await fetch(fetchUrl);

        if (!response.ok)
            throw new Error("Não foi possível buscar os dados do vídeo");

        const data = await response.json();

        // Retorna um objeto limpo com o que você realmente precisa
        return {
            title: data.title,
            thumbnail: data.thumbnail_url,
            // Extrai a URL limpa do iframe usando Regex
            embedUrl: data.html.match(/src="([^"]+)"/)?.[1] || "",
            author: data.author_name,
        };
    } catch (error) {
        console.error("Erro ao buscar metadados do YouTube:", error);
        return null;
    }
};
