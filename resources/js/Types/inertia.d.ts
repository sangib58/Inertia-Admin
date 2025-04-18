import { PageProps as InertiaPageProps } from "@inertiajs/core";

declare module "@inertiajs/vue3" {
    interface PageProps extends InertiaPageProps {
        appSettings: any;
        auth: {
            user: {
                id: number;
                name: string;
                email: string;
                roleId: number;
                roleName: string;
                imagePath?: string;
            };
        };
        menu?: any;
        notifications?: any;
        flash: {
            success?: string;
            error?: string;
        };
    }
}
