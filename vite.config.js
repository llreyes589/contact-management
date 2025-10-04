import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue"; // Import the Vue plugin
import tailwindcss from "@tailwindcss/vite";

import collectModuleAssetsPaths from "./vite-module-loader.js";

const paths = ["resources/css/app.css", "resources/js/app.js"];
const allPaths = await collectModuleAssetsPaths(paths, "Modules");


export default defineConfig({
    plugins: [
        laravel({
            input: allPaths,
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
