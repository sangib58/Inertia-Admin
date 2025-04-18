<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex min-w-[680px] flex-col space-y-10 rounded-md bg-white px-4 py-6">
                <div v-if="isEdit == true" class="text-xl font-semibold">
                    Edit Menu Group
                </div>
                <div v-else class="text-xl font-semibold">Add Menu Group</div>
                <form @submit.prevent="saveMenuGroup" class="space-y-8">
                    <div>
                        <label
                            class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Menu
                            Group</label>
                        <input type="text" v-model="menuGroupForm.menuGroupName" autocomplete="off"
                            class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        <p v-if="menuGroupForm.errors.menuGroupName" class="mt-2 text-sm text-red-500">
                            {{ menuGroupForm.errors.menuGroupName }}
                        </p>
                    </div>
                    <div class="flex justify-end space-x-4 text-sm font-bold text-white">
                        <button @click.stop="cancel" class="cursor-pointer text-blue-500 hover:text-blue-600">
                            Cancel
                        </button>
                        <button class="text-gray-700 cursor-pointer hover:text-gray-800 disabled:text-gray-300"
                            type="submit" :disabled="menuGroupForm.processing">
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
    obj: Partial<MenuGroup>;
}
interface MenuGroup {
    menuGroupId: number;
    menuGroupName: string;
}
interface MenuGroupForm extends MenuGroup {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const toast = useToast();
const props = defineProps<Props>();
const emit = defineEmits<{
    (e: "close", value: boolean): void
}>();
const menuGroupForm = useForm<MenuGroupForm>({
    menuGroupId: 0,
    menuGroupName: "",
});

//check add or edit
const isEdit = computed(() => {
    if (props.obj?.menuGroupId == undefined) {
        return false;
    }
    Object.assign(menuGroupForm, {
        menuGroupId: props.obj.menuGroupId ?? 0,
        menuGroupName: props.obj.menuGroupName ?? "",
    })
    return true;
});

//calcel action
const cancel = () => {
    emit("close", false);
};

//menu group add/edit
const saveMenuGroup = () => {
    const requestConfig = {
        preserveState: true,
        onSuccess: () => {
            toast.success(`Menu Group ${isEdit.value ? "updated" : "added"} successfully.`);
            emit("close", false);
            menuGroupForm.reset();
        },
    };
    isEdit.value
        ? menuGroupForm.put('/update-menu-group', requestConfig)
        : menuGroupForm.post('/add-menu-group', requestConfig)
};
</script>