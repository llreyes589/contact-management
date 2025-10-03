import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue"; // Import the Vue plugin
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                // Add your module's entry points here
                "Modules/Contact/Resources/assets/js/app.js",
                "Modules/Contact/Resources/assets/sass/app.scss",
            ],
            refresh: true,
        }),
        vue({
            // Add the Vue plugin
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        tailwindcss(),
    ],
});
