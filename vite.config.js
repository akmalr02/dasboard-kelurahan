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
        target: ["es2015", "safari10"],
        rollupOptions: {
            output: {
                manualChunks: undefined,
            },
        },
    },
}));
