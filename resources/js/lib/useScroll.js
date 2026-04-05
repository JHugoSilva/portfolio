import { onMounted, onBeforeUnmount, ref } from "vue";

export function useScroll() {
    const activeSection = ref("");
    let timeout;

    const saveScroll = () => {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            localStorage.setItem("scroll-position", window.scrollY);

            const sections = document.querySelectorAll("section[id]");
            let current = "";

            sections.forEach((section) => {
                const top = section.offsetTop - 150;
                const height = section.offsetHeight;

                if (window.scrollY >= top && window.scrollY < top + height) {
                    current = section.id;
                }
            });

            if (current) {
                activeSection.value = current; // 🔥 atualiza aqui
                localStorage.setItem("active-section", current);
            }
        }, 200);
    };

    const goToSection = (id) => {
        activeSection.value = id;
        localStorage.setItem("active-section", id);

        document.getElementById(id)?.scrollIntoView({
            behavior: "smooth",
        });
    };

    onMounted(() => {
        // 🔥 RESTAURA automaticamente
        const saved = localStorage.getItem("active-section");

        if (saved) {
            activeSection.value = saved;
            document.getElementById(saved)?.scrollIntoView();
        }

        const scrollPosition = localStorage.getItem("scroll-position");
        if (scrollPosition) {
            window.scrollTo(0, parseInt(scrollPosition));
        }

        window.addEventListener("scroll", saveScroll);
    });

    onBeforeUnmount(() => {
        window.removeEventListener("scroll", saveScroll);
    });

    return {
        activeSection,
        goToSection,
    };
}
