import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                `resources/views/**/*`,
                "app/Livewire/**/*.php",
                "resources/views/livewire/**/*.blade.php",
            ],
        }),
        tailwindcss(),
    ],
    server: {
        cors: true,
        hmr: {
            host: "localhost",
        },
    },
    build: {
        manifest: true,
        outDir: "public/build",
        assetsDir: "assets",
        rollupOptions: {
            output: {
                manualChunks: {
                    charts: ["chart.js", "chartjs-plugin-datalabels"],
                },
                assetFileNames: "assets/[name]-[hash][extname]",
                chunkFileNames: "assets/[name]-[hash].js",
                entryFileNames: "assets/[name]-[hash].js",
            },
        },
    },
});
