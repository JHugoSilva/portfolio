import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";
import path from "path";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css", // CSS puro
                "resources/js/app.js", // JS com Vue
            ],
            refresh: true, // atualiza Blade automaticamente
        }),
        vue(), // plugin Vue
    ],
    build: {
        outDir: path.resolve(__dirname, "public/build"), // pasta final
        emptyOutDir: true, // limpa antes do build
        rollupOptions: {
            output: {
                entryFileNames: "assets/[name].[hash].js", // JS hash
                chunkFileNames: "assets/[name].[hash].js", // chunks
                assetFileNames: "assets/[name].[hash].[ext]", // CSS e outros assets
            },
        },
        assetsDir: "assets", // mantém todos os assets dentro de /build/assets
    },
    base: "/build/", // caminho relativo no navegador
});
