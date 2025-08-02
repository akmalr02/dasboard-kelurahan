import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig(({ mode }) => ({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: [
                "resources/views/**/*",
                "app/Livewire/**/*.php",
                "resources/views/livewire/**/*.blade.php",
            ],
        }),
        tailwindcss(),
    ],
    server: {
        host: "0.0.0.0",
        port: 5173,
        cors: true,
        hmr: {
            host: "localhost",
            port: 5173,
        },
    },
    build: {
        outDir: "public/build",
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            output: {
                manualChunks: {
                    charts: ["chart.js", "chartjs-plugin-datalabels"],
                },
            },
        },
    },
    // Pastikan base URL benar untuk production
    base:
        mode === "production"
            ? "https://dashboard-kelurahan-production.up.railway.app/build/"
            : "/build/",
}));
