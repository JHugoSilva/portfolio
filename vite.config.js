// import { defineConfig } from "vite";
// import laravel from "laravel-vite-plugin";
// import tailwindcss from "@tailwindcss/vite";
// import vue from "@vitejs/plugin-vue";

// export default defineConfig({
//     plugins: [
//         laravel({
//             input: ["resources/css/app.css", "resources/js/app.js"],
//             refresh: true,
//         }),
//         // tailwindcss(),
//         vue(),
//     ],
//     server: {
//         watch: {
//             ignored: ["**/storage/framework/views/**"],
//         },
//     },
// });

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [vue()],
    build: {
        outDir: "public/build",
        emptyOutDir: true,
        rollupOptions: {
            input: {
                main: path.resolve(__dirname, "resources/js/app.js"),
            },
        },
        assetsDir: "assets",
    },
    base: "/build/",
});
