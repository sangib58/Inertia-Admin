<template>
    <div class="px-4 py-4">
        <form @submit.prevent="changePassword">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-12">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Password</label>
                    <input type="password" v-model="passwordForm.password" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="passwordForm.errors.password" class="mt-2 text-sm text-red-500">
                        {{ passwordForm.errors.password }}
                    </p>
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Confirm
                        Password</label>
                    <input type="password" v-model="passwordForm.confirmPassword" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="passwordForm.errors.confirmPassword" class="mt-2 text-sm text-red-500">
                        {{ passwordForm.errors.confirmPassword }}
                    </p>
                </div>
                <div>
                    <button :disabled="passwordForm.processing" type="submit"
                        class="cursor-pointer mt-4 w-20 rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Change
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import { PageProps } from "@inertiajs/vue3";
import Root from '../../Layouts/root.vue';
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
defineOptions({
    layout: Root
})

interface PasswordForm {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const passwordForm = useForm<PasswordForm>({
    password: "",
    confirmPassword: "",
});
const toast = useToast();
const successMessage = computed(() => usePage<PageProps>().props.flash.success);

//password change
const changePassword = () => {
    passwordForm.post('/change-password-post', {
        onSuccess: () => {
            if (Object.keys(passwordForm.errors).length == 0) {
                passwordForm.reset();
                toast.success(successMessage.value);
            }
        }
    })
};
</script>