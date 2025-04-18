<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex min-w-[680px] flex-col space-y-10 rounded-md bg-white px-4 py-6">
                <div v-if="isEdit == true" class="text-xl font-semibold">Edit Role</div>
                <div v-else class="text-xl font-semibold">Add Role</div>
                <form @submit.prevent="saveRole" class="space-y-8">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Name</label>
                        <input type="text" v-model="roleForm.roleName" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="roleForm.errors.roleName" class="mt-2 text-sm text-red-500">
                            {{ roleForm.errors.roleName }}
                        </p>
                    </div>
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Menu
                            Group</label>
                        <select v-model="roleForm.menuGroupId"
                            class="mt-1 w-full appearance-none border-b border-gray-300 p-1 text-sm text-gray-700 shadow-sm outline-none focus:border-blue-600">
                            <option value="" class="text-sm font-medium text-gray-700" disabled>
                                Select Menu Group
                            </option>
                            <option v-for="item in props.menuGroupList" :key="item.menuGroupId"
                                :value="item.menuGroupId" class="text-sm font-medium text-gray-700">
                                {{ item.menuGroupName }}
                            </option>
                        </select>
                        <p v-if="roleForm.errors.menuGroupId" class="mt-2 text-sm text-red-500">
                            {{ roleForm.errors.menuGroupId }}
                        </p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea v-model="roleForm.roleDesc"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600"
                            rows="3"></textarea>
                        <p v-if="roleForm.errors.roleDesc" class="mt-2 text-sm text-red-500">
                            {{ roleForm.errors.roleDesc }}
                        </p>
                    </div>
                    <div class="flex justify-end space-x-4 text-sm font-bold text-white">
                        <button @click.stop="cancel" class="cursor-pointer text-blue-500 hover:text-blue-600">
                            Cancel
                        </button>
                        <button class="cursor-pointer text-gray-700 hover:text-gray-800 disabled:text-gray-300"
                            type="submit" :disabled="roleForm.processing">
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
import { computed } from "vue";
import { useToast } from "vue-toastification";

interface Props {
    show: boolean;
    obj: Partial<Role>;
    menuGroupList: MenuGroup[];
}
interface MenuGroup {
    menuGroupId: number;
    menuGroupName: string;
}
interface Role {
    userRoleId: number;
    menuGroupId: number;
    roleName: string;
    roleDesc: string;
}
interface RoleForm extends Role {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const toast = useToast();
const props = defineProps<Props>();
const emit = defineEmits<{
    (e: "close", value: boolean): void
}>();
const roleForm = useForm<RoleForm>({
    userRoleId: 0,
    menuGroupId: 0,
    roleName: "",
    roleDesc: "",
});

//check add or edit
const isEdit = computed(() => {
    if (props.obj?.userRoleId == undefined) {
        return false;
    }
    Object.assign(roleForm, {
        userRoleId: props.obj.userRoleId ?? 0,
        menuGroupId: props.obj.menuGroupId ?? 0,
        roleName: props.obj.roleName ?? "",
        roleDesc: props.obj.roleDesc ?? "",
    })
    return true;
});

//calcel action
const cancel = () => {
    emit("close", false);
};

//role add/edit
const saveRole = () => {
    const requestConfig = {
        preserveState: true,
        onSuccess: () => {
            toast.success(`Role ${isEdit.value ? "updated" : "added"} successfully.`);
            emit("close", false);
            roleForm.reset();
        },
    };
    isEdit.value
        ? roleForm.put('/update-role', requestConfig)
        : roleForm.post('/add-role', requestConfig)
};
</script>