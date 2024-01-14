import './bootstrap';
import '../css/app.css';
import '@fortawesome/fontawesome-free/css/all.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import 'vue-toast-notification/dist/theme-default.css';
import { loadMercadoPago } from "@mercadopago/sdk-js";
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

// await loadMercadoPago();
// const mp = new window.MercadoPago("TEST-338486df-8c1b-4f73-94c6-0375085a30d5");

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component('VueDatePicker', VueDatePicker)
            
            
            .mount(el);

            
            
    },
    progress: {
        color: '#4B5563',
    },
});
