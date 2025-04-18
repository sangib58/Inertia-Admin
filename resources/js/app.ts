import "../css/app.css";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

//toast options
const toastOptions = {
    position: "top-right",
    timeout: 3000,
    closeOnClick: true,
    pauseOnFocusLoss: true,
    pauseOnHover: true,
    draggable: true,
    draggablePercent: 0.6,
    showCloseButtonOnHover: false,
    hideProgressBar: false,
    closeButton: "button",
    icon: true,
    rtl: false,
};

// Validation rules
const validationRules = {
    required: (value: string) => !!value || "This field is required",
    email: (value: string) =>
        /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(value) ||
        "Invalid email address",
    minLength: (value: string, length: number) =>
        (value && value.length >= length) ||
        `Must be at least ${length} characters`,
};

createInertiaApp({
    resolve: (name: string): any => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        return pages[`./Pages/${name}.vue`];
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast, toastOptions)
            .provide("validationRules", validationRules)
            .mount(el);
    },
});
