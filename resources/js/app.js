import './bootstrap';
import "../css/app.pcss"
import { createInertiaApp } from '@inertiajs/svelte'
import Layout from "./Layouts/Layout.svelte";

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.svelte', { eager: true })
        const page =  pages[`./Pages/${name}.svelte`];

        return {
            default: page.default,
            layout: Layout,
        }
    },
    setup({ el, App, props }) {
        new App({ target: el, props })
    },
})
