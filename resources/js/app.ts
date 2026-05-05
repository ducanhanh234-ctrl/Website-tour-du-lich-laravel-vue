import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';

import AuthLayout from '@/layouts/AuthLayout.vue';
import AppLayout from '@/layouts/AppLayout.vue';

import { initializeTheme } from '@/composables/useAppearance';
import { initializeFlashToast } from '@/lib/flashToast';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import 'bootstrap-icons/font/bootstrap-icons.css';

import axios from 'axios';

import { ZiggyVue } from 'ziggy-js';
declare global {
    interface Window {
        Ziggy: any;
    }
}
if (typeof window !== 'undefined') {
    (window as any).axios = axios;
    (window as any).axios.defaults.headers.common['X-Requested-With'] =
        'XMLHttpRequest';
}

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),

    resolve: async (name) => {
        const page = (await resolvePageComponent(
            `./pages/${name}.vue`,
            import.meta.glob('./pages/**/*.vue'),
        )) as { default: any };

        page.default.layout =
            page.default.layout ??
            (name === 'Welcome'
                ? null
                : name.startsWith('auth/')
                  ? AuthLayout
                  : AppLayout);

        return page.default;
    },

    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: '#4B5563',
    },
});

initializeTheme();
initializeFlashToast();
