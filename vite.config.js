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
import laravel from "laravel-vite-plugin";
import path from "path";

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"], // ✅ incluir CSS
            buildDirectory: "build",
        }),
    ],
    build: {
        outDir: path.resolve(__dirname, "public/build"),
        emptyOutDir: true,
        rollupOptions: {
            output: {
                // deixe Vite gerar nomes hashados automaticamente
                entryFileNames: "assets/[name].[hash].js",
                chunkFileNames: "assets/[name].[hash].js",
                assetFileNames: "assets/[name].[hash].[ext]",
            },
        },
        assetsDir: "assets",
    },
    base: "/build/",
});
