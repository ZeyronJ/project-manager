import path from "path";
import { defineConfig } from "vite";
import laravel, { refreshPaths } from "laravel-vite-plugin";

export default defineConfig({
    root: path.resolve(__dirname),
    optimizeDeps: {
        include: ["flowbite", "datepciker"],
    },
    resolve: {
        alias: {
            flowbite: "node_modules/flowbite/dist/flowbite.js",
        },
    },
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/bootstrap.js",
                "resources/js/chart.js",
                "resources/js/directory_delete.js",
                "resources/js/modificationform.js",
                "node_modules/flowbite/dist/flowbite.js",
                "node_modules/flowbite/dist/datepicker.js",
            ],
            refresh: [...refreshPaths, "app/Http/Livewire/**"],
        }),
    ],
});
