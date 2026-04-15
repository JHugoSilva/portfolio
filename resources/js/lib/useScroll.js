import { onMounted, onBeforeUnmount, ref } from "vue";
import { useRoute, useRouter } from "vue-router";

export function useScroll() {
    const route = useRoute();
    const router = useRouter();
    const activeSection = ref(route.hash.replace("#", "") || "home");

    const handleScroll = () => {
        const sections = document.querySelectorAll("section[id]");
        let current = "";

        sections.forEach((section) => {
            const top = section.offsetTop - 150;
            if (window.scrollY >= top) {
                current = section.id;
            }
        });

        if (current && activeSection.value !== current) {
            activeSection.value = current;
            // Opcional: Atualiza a URL sem recarregar a página
            // history.replaceState(null, null, `#${current}`);
        }
    };

    const goToSection = (id) => {
        router.push({ hash: `#${id}` });
    };

    onMounted(() => {
        window.addEventListener("scroll", handleScroll);
    });

    onBeforeUnmount(() => {
        window.removeEventListener("scroll", handleScroll);
    });

    return { activeSection, goToSection };
}
