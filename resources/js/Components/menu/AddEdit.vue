<template>
    <Teleport to="body" v-if="show">
        <div class="fixed inset-0 z-50 flex min-h-dvh items-center justify-center bg-black/50">
            <div class="flex max-w-[780px] flex-col space-y-10 rounded-md bg-white px-4 py-6">
                <div v-if="isEdit == true" class="text-xl font-semibold">Edit Menu</div>
                <div v-else class="text-xl font-semibold">Add Menu</div>
                <form @submit.prevent="saveMenu" class="flex flex-col space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 md:gap-x-3 md:gap-y-3">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Name</label>
                            <input type="text" v-model="menuForm.menuTitle" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                            <p v-if="menuForm.errors.menuTitle" class="mt-2 text-sm text-red-500">
                                {{ menuForm.errors.menuTitle }}
                            </p>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Parent</label>
                            <select v-model="menuForm.parentID"
                                class="w-full appearance-none border-b border-gray-300 p-1 text-sm text-gray-700 outline-none focus:border-blue-600">
                                <option value="" class="text-sm font-medium text-gray-700" disabled>
                                    Select parent
                                </option>
                                <option v-for="item in props.parentMenus" :key="item.id" :value="item.id"
                                    class="text-sm font-medium text-gray-700">
                                    {{ item.text }}
                                </option>
                            </select>
                            <p v-if="menuForm.errors.parentID" class="mt-2 text-sm text-red-500">
                                {{ menuForm.errors.parentID }}
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">URL</label>
                            <input type="text" v-model="menuForm.url" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        </div>
                        <div v-if="menuForm.parentID == 0">
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Order</label>
                            <input type="number" v-model="menuForm.sortOrder" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                            <p v-if="menuForm.errors.sortOrder" class="mt-2 text-sm text-red-500">
                                {{ menuForm.errors.sortOrder }}
                            </p>
                        </div>
                        <div v-if="menuForm.parentID == 0">
                            <label
                                class="block text-sm font-medium text-gray-700 after:ml-0.5 after:text-red-500 after:content-['*']">Icon
                                Class</label>
                            <input type="text" v-model="menuForm.iconClass" autocomplete="off"
                                class="mt-1 w-full border-b border-gray-300 outline-none focus:border-blue-600" />
                        </div>
                    </div>
                    <div class="flex justify-end space-x-4 text-sm font-bold text-white">
                        <button @click.stop="cancel" class="cursor-pointer text-blue-500 hover:text-blue-600">
                            Cancel
                        </button>
                        <button class="cursor-pointer text-gray-700 hover:text-gray-800 disabled:text-gray-300"
                            type="submit" :disabled="menuForm.processing">
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
import { computed, Prop } from "vue";
import { useToast } from "vue-toastification";

interface ParentMenu {
    id: number;
    text: string;
}
interface Props {
    show: boolean;
    obj: Partial<Menu>;
    parentMenus: ParentMenu[];
}
interface Menu {
    menuID: number;
    parentID: number;
    menuTitle: string;
    url: string;
    isSubMenu: number;
    sortOrder: number;
    iconClass: string;
}
interface MenuForm extends Menu {
    [key: string]: any;
    errors?: Record<string, string>;
    processing?: boolean;
}
const toast = useToast();
const props = defineProps<Props>();
const emit = defineEmits(["close"]);
const menuForm = useForm<MenuForm>({
    menuID: 0,
    parentID: 0,
    menuTitle: "",
    url: "",
    isSubMenu: 0,
    sortOrder: 0,
    iconClass: "",
});

//check add or edit
const isEdit = computed(() => {
    if (props.obj?.menuID == undefined) {
        return false;
    }
    Object.assign(menuForm, {
        menuID: props.obj.menuID ?? 0,
        parentID: props.obj.parentID ?? 0,
        menuTitle: props.obj.menuTitle ?? "",
        url: props.obj.url ?? "",
        isSubMenu: props.obj.isSubMenu ?? 0,
        sortOrder: props.obj.sortOrder ?? 0,
        iconClass: props.obj.iconClass ?? "",
    })
    return true;
});

//calcel action
const cancel = () => {
    emit("close", false);
};

//menu add/edit
const saveMenu = () => {
    const requestConfig = {
        preserveState: true,
        onSuccess: () => {
            toast.success(`Menu ${isEdit.value ? "updated" : "added"} successfully.`);
            emit("close", false);
            menuForm.reset();
        },
    };
    isEdit.value
        ? menuForm.put('/update-menu', requestConfig)
        : menuForm.post('/add-menu', requestConfig)
};
</script>
