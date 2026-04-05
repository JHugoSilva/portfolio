import "./bootstrap";
import { createApp } from "vue";
import Swal from "sweetalert2";

window.Swal = Swal;

const toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
});

window.toast = toast;

const mountApp = async () => {
    if (window.location.pathname.startsWith("/admin")) {
        console.log("ADMIN");
        const { default: Admin } = await import("./Admin.vue");
        const { default: router } = await import("./router/admin");

        createApp(Admin).use(router).mount("#admin");
    } else {
        const { default: App } = await import("./App.vue");
        const { default: router } = await import("./router");

        createApp(App).use(router).mount("#app");
    }
};

mountApp();
