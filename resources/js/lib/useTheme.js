// composables/useTheme.js
export function useTheme(buttonId = "theme-button") {
    const initTheme = () => {
        console.log("AQI");

        const themeButton = document.getElementById(buttonId);
        if (!themeButton) return;

        const darkTheme = "dark-theme";
        const iconTheme = "uil-sun";

        // 👉 pegar do localStorage
        const selectedTheme = localStorage.getItem("selected-theme");
        const selectedIcon = localStorage.getItem("selected-icon");

        // 👉 aplicar tema salvo
        if (selectedTheme) {
            document.body.classList[
                selectedTheme === "dark" ? "add" : "remove"
            ](darkTheme);

            themeButton.classList[
                selectedIcon === "uil-moon" ? "add" : "remove"
            ](iconTheme);
        }

        // 👉 evento de clique
        themeButton.addEventListener("click", () => {
            document.body.classList.toggle(darkTheme);
            themeButton.classList.toggle(iconTheme);

            // 👉 salvar escolha
            const currentTheme = document.body.classList.contains(darkTheme)
                ? "dark"
                : "light";

            const currentIcon = themeButton.classList.contains(iconTheme)
                ? "uil-moon"
                : "uil-sun";

            localStorage.setItem("selected-theme", currentTheme);
            localStorage.setItem("selected-icon", currentIcon);
        });
    };

    return {
        initTheme,
    };
}
