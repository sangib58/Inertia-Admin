<template>
    <div class="px-4 py-4">
        <form @submit.prevent="updateProfile" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-12 md:gap-y-4">
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Name</label>
                    <input type="text" v-model="userForm.fullName" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="userForm.errors.fullName" class="mt-2 text-sm text-red-500">
                        {{ userForm.errors.fullName }}
                    </p>
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Email</label>
                    <input type="email" v-model="userForm.email" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="userForm.errors.email" class="mt-2 text-sm text-red-500">
                        {{ userForm.errors.email }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mobile</label>
                    <input type="text" v-model="userForm.mobile" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="userForm.errors.mobile" class="mt-2 text-sm text-red-500">
                        {{ userForm.errors.mobile }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date Of Birth</label>
                    <DatePicker v-model="userForm.dateOfBirth" autocomplete="off"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="userForm.errors.dateOfBirth" class="mt-2 text-sm text-red-500">
                        {{ userForm.errors.dateOfBirth }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                    <input type="file" accept="image/*" @change="onProfileImageChange"
                        class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                    <p v-if="userForm.errors.image" class="mt-2 text-sm text-red-500">
                        {{ userForm.errors.image }}
                    </p>
                </div>
                <div>
                    <img :src="previewImage" class="size-16 object-contain" />
                </div>
                <div>
                    <button :disabled="userForm.processing" type="submit"
                        class="mt-4 w-20 cursor-pointer rounded-md bg-dark-gray py-2 text-sm font-bold text-white disabled:bg-gray-300">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script lang="ts" setup>
import DatePicker from "vue3-datepicker";
import { PageProps } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Root from '../../Layouts/root.vue';
defineOptions({ layout: Root });

interface User {
    email: string;
    mobile: string;
    fullName: string;
    dateOfBirth: Date | null;
    imagePath: string | null;
}
interface UserForm extends User {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
interface Props {
    userInfo: User
}
const props = defineProps<Props>();
import { usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
const userForm = useForm<UserForm>({
    email: "",
    mobile: "",
    fullName: "",
    dateOfBirth: null,
    image: null,
    imagePath: null,
});
const previewImage = ref('');
const toast = useToast();
const successMessage = computed(() => usePage<PageProps>().props.flash.success);

if (props.userInfo != null) {
    userForm.email = props.userInfo?.email;
    userForm.mobile = props.userInfo?.mobile;
    userForm.fullName = props.userInfo?.fullName;
    //userForm.dateOfBirth = props.userInfo?.dateOfBirth != null ? new Date(props.userInfo?.dateOfBirth.toISOString().slice(0, 10)) : null;
    userForm.dateOfBirth = props.userInfo?.dateOfBirth != null ? new Date(props.userInfo?.dateOfBirth) : null;
    previewImage.value = props.userInfo?.imagePath ? window.location.origin + '/images/' + props.userInfo?.imagePath : '';
    userForm.imagePath = props.userInfo?.imagePath;
}

const onProfileImageChange = (event: any) => {
    userForm.image = event.target.files[0];
}

const updateProfile = () => {
    userForm.post("/update-profile", {
        forceFormData: true,
        onSuccess: () => {
            if (Object.keys(userForm.errors).length == 0) {
                previewImage.value = window.location.origin + '/images/' + usePage().props.userInfo.imagePath;
                toast.success(successMessage.value);
            }
        }
    });
}
</script>