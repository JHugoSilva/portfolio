import { ref, onMounted } from "vue";

export function useTheme() {
    const darkTheme = "dark-theme";
    const iconTheme = "uil-sun"; // Ícone que aparece quando está dark

    const toggleTheme = () => {
        // 1. Alterna a classe no Body
        document.body.classList.toggle(darkTheme);

        // 2. Salva a preferência
        const currentTheme = document.body.classList.contains(darkTheme)
            ? "dark"
            : "light";
        localStorage.setItem("selected-theme", currentTheme);

        // Disparamos um evento customizado para que todos os ícones na página se atualizem
        window.dispatchEvent(new Event("theme-changed"));
    };

    const initTheme = () => {
        const selectedTheme = localStorage.getItem("selected-theme");
        if (selectedTheme === "dark") {
            document.body.classList.add(darkTheme);
        }
    };

    return {
        initTheme,
        toggleTheme,
    };
}
