<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex max-w-[780px] flex-col space-y-10 rounded-md bg-white px-4 py-6">
                <div v-if="isEdit == true" class="text-xl font-semibold">Edit User</div>
                <div v-else class="text-xl font-semibold">Add User</div>
                <form @submit.prevent="saveUser" class="flex flex-col space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-3 md:gap-y-3">
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
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Role</label>
                            <select v-model="userForm.userRoleId"
                                class="w-full appearance-none border-b border-gray-300 p-1 text-sm text-gray-700 outline-none focus:border-blue-600">
                                <option value="" class="text-sm font-medium text-gray-700" disabled>
                                    Select Role
                                </option>
                                <option v-for="item in props.roles" :key="item.userRoleId" :value="item.userRoleId"
                                    class="text-sm font-medium text-gray-700">
                                    {{ item.roleName }}
                                </option>
                            </select>
                            <p v-if="userForm.errors.userRoleId" class="mt-2 text-sm text-red-500">
                                {{ userForm.errors.userRoleId }}
                            </p>
                        </div>
                        <div v-if="isEdit == false">
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Password</label>
                            <input type="password" v-model="userForm.password" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                            <p v-if="userForm.errors.password" class="mt-2 text-sm text-red-500">
                                {{ userForm.errors.password }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date Of Birth</label>
                            <DatePicker v-model="userForm.dateOfBirth" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile</label>
                            <input type="text" v-model="userForm.mobile" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Profile Picture</label>
                            <input type="file" accept="image/*" @change="onProfileImageChange"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        </div>
                        <div v-if="previewImage != null">
                            <img :src="previewImage" class="size-16 object-contain" />
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4 text-sm font-bold text-white">
                        <button @click.stop="cancel" class="cursor-pointer text-blue-500 hover:text-blue-600">
                            Cancel
                        </button>
                        <button class="cursor-pointer text-gray-700 hover:text-gray-800 disabled:text-gray-300"
                            type="submit" :disabled="userForm.processing">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Teleport>
</template>

<script lang="ts" setup>
import { useForm } from "@inertiajs/vue3";
import DatePicker from "vue3-datepicker";
import { computed, ref } from "vue";
import { useToast } from "vue-toastification";

interface Props {
    show: boolean;
    obj: Partial<User>;
    roles: Role[];
}
interface Role {
    userRoleId: number;
    roleName: string;
}
interface User {
    userId: number,
    userRoleId: number,
    fullName: string,
    mobile: string,
    email: string,
    password: string,
    dateOfBirth: Date,
    imagePath: string | null,
}
interface UserForm extends User {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const toast = useToast();
const previewImage = ref('');
const props = defineProps<Props>();
const emit = defineEmits<{
    (e: "close", value: boolean): void
}>();
const userForm = useForm<UserForm>({
    userId: 0,
    userRoleId: 0,
    fullName: "",
    mobile: "",
    email: "",
    password: "",
    dateOfBirth: new Date(),
    image: null,
    imagePath: null,
});

//check add or edit
const isEdit = computed(() => {
    if (props.obj?.userId == undefined) {
        return false;
    }
    Object.assign(userForm, {
        userId: props.obj.userId ?? 0,
        userRoleId: props.obj.userRoleId ?? 0,
        fullName: props.obj.fullName ?? "",
        email: props.obj.email ?? "",
        password: props.obj.password ?? "",
        mobile: props.obj.mobile ?? "",
        imagePath: props.obj.imagePath ?? null,
        dateOfBirth:
            props.obj.dateOfBirth != null
                ? new Date(props.obj.dateOfBirth.toISOString().slice(0, 10))
                : null
    })
    previewImage.value =
        props.obj.imagePath == null
            ? ''
            : window.location.origin + '/images/' + props.obj.imagePath;
    return true;
    /* else {
        userForm.userId = props.obj.userId;
        userForm.userRoleId = props.obj.userRoleId;
        userForm.fullName = props.obj.fullName;
        userForm.email = props.obj.email;
        userForm.password = props.obj.password;
        userForm.mobile = props.obj.mobile;
        userForm.imagePath = props.obj.imagePath;
        userForm.dateOfBirth =
            props.obj.dateOfBirth != null
                ? new Date(props.obj.dateOfBirth.substr(0, 10))
                : null;
        previewImage.value =
            props.obj.imagePath == null
                ? null
                : window.location.origin + '/images/' + props.obj.imagePath;

        return true;
    } */
});

//on profile image change
const onProfileImageChange = (event: any) => {
    userForm.image = event.target.files[0];
};

//calcel action
const cancel = () => {
    emit("close", false);
};

//user add/edit
const saveUser = () => {
    if (isEdit.value) {
        userForm.post('/update-user', {
            forceFormData: true,
            onSuccess: () => {
                if (Object.keys(userForm.errors).length == 0) {
                    toast.success("User updated successfully.");
                    emit("close", false);
                    userForm.reset();
                }
            },
        });
    } else {
        userForm.post('/add-user', {
            forceFormData: true,
            onSuccess: () => {
                if (Object.keys(userForm.errors).length == 0) {
                    toast.success("User added successfully.");
                    emit("close", false);
                    userForm.reset();
                }
            },
        });
    }
};
</script>