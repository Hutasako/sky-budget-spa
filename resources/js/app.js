import './bootstrap';
import '../css/app.css';

import 'primeicons/primeicons.css'

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { plugin as FormKitPlugin, defaultConfig } from '@formkit/vue'

import PrimeVue from 'primevue/config';
import Lara from '../presets/lara';

import Slider from 'primevue/slider';
import DataTable from 'primevue/datatable';
import InputText from 'primevue/inputtext';
import Tooltip from 'primevue/tooltip';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(PrimeVue, { unstyled: true, pt: Lara })
            .use(FormKitPlugin, defaultConfig)
            .component("Slider", Slider)
            .component("DataTable", DataTable)
            .component("InputText", InputText)
            .directive('tooltip', Tooltip)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
