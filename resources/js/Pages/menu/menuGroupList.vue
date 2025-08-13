<template>
    <div class="px-4 py-6">
        <div class="flex justify-end">
            <button
                @click.stop="openAdd"
                class="cursor-pointer mb-1 rounded bg-dark-gray px-3 py-1.5 text-sm text-white hover:bg-dark-black disabled:bg-gray-300"
            >
                Add Menu Group
            </button>
        </div>
        <table
            class="min-w-full border-collapse rounded-md border border-gray-200"
        >
            <thead>
                <tr class="bg-gray-100">
                    <th
                        class="px-4 py-2 text-left text-sm font-medium text-gray-600"
                    >
                        Menu Group
                    </th>
                    <th
                        class="px-4 py-2 text-left text-sm font-medium text-gray-600"
                    >
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="item in paginatedData"
                    :key="item.menuGroupId"
                    class="border-t hover:bg-gray-50"
                >
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.menuGroupName }}
                    </td>

                    <td class="flex space-x-1 px-4 py-2">
                        <span
                            class="cursor-pointer"
                            @click.stop="openEdit(item)"
                        >
                            <Icon
                                icon-name="mdiPencil"
                                size="18"
                                color="#3a484a"
                            />
                        </span>
                        <span
                            class="cursor-pointer"
                            @click.stop="openDelete(item)"
                        >
                            <Icon
                                icon-name="mdiDelete"
                                size="18"
                                color="#3a484a"
                            />
                        </span>
                        <span
                            class="cursor-pointer"
                            @click.stop="openMenuAssign(item)"
                        >
                            <Icon
                                icon-name="mdiMenu"
                                size="18"
                                color="#3a484a"
                            />
                        </span>
                    </td>
                </tr>
                <tr v-if="paginatedData.length === 0">
                    <td
                        colspan="3"
                        class="px-4 py-2 text-center text-sm text-gray-500"
                    >
                        No data available.
                    </td>
                </tr>
            </tbody>
        </table>
        <TableFooter
            :total-items="props.menuGroups.length"
            :items-per-page="itemsPerPage"
            :current-page="currentPage"
            @current-page-change="updateCurrentPage"
        />
        <AddEdit
            v-if="showAddEdit"
            :show="showAddEdit"
            :obj="objMenuGroup"
            @close="closeAddEdit"
        />
        <Delete
            v-if="showDelete"
            :show="showDelete"
            :id="menuGroupId"
            @close="closeDelete"
        />
        <AssignMenu
            v-if="showMenuAssign"
            :show="showMenuAssign"
            :id="menuGroupId"
            :allMenu="allMenu"
            @close="closeMenuAssign"
        />
    </div>
</template>

<script lang="ts" setup>
import Delete from "../../Components/menuGroup/Delete.vue";
import AddEdit from "../../Components/menuGroup/AddEdit.vue";
import AssignMenu from "./AssignMenu.vue";
import TableFooter from "../../Components/helper/TableFooter.vue";
import Root from "../../Layouts/root.vue";
import Icon from "../../Components/helper/Icon.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
defineOptions({ layout: Root });

interface MenuGroup {
    menuGroupId: number;
    menuGroupName: string;
}
interface Props {
    menuGroups: MenuGroup[];
}
const props = defineProps<Props>();
const itemsPerPage = ref(10);
const currentPage = ref(1);
const showDelete = ref(false);
const showAddEdit = ref(false);
const showMenuAssign = ref(false);
const menuGroupId = ref(0);
const objMenuGroup = ref<Partial<MenuGroup>>({});
const menuGroupForm = useForm({});
const allMenu = ref([]);

const openAdd = () => {
    objMenuGroup.value = {};
    showAddEdit.value = !showAddEdit.value;
};

const openEdit = (item: MenuGroup) => {
    objMenuGroup.value = item;
    showAddEdit.value = !showAddEdit.value;
};

const closeAddEdit = (confirmed: boolean) => {
    showAddEdit.value = confirmed;
};

const openDelete = (item: MenuGroup) => {
    showDelete.value = !showDelete.value;
    menuGroupId.value = item.menuGroupId;
};

const openMenuAssign = (item: MenuGroup) => {
    menuGroupId.value = item.menuGroupId;
    showMenuAssign.value = true;
    menuGroupForm.get(`/sidebar-menu/${item.menuGroupId}`, {
        preserveState: true,
        onSuccess: (response) => {
            //console.log('item', item)
            //console.log('response', response.props.sidebar)
            allMenu.value = response.props.sidebar;
            //console.log(usePage().props)
        },
        onError: () => {
            console.log("Error fetching menu data");
        },
    });
};

const closeDelete = (confirmed: boolean) => {
    showDelete.value = confirmed;
};
const closeMenuAssign = (confirmed: boolean) => {
    showMenuAssign.value = confirmed;
};

//get paginated data
const paginatedData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.menuGroups.slice(start, end);
});

//current page number update
const updateCurrentPage = (page: number) => {
    currentPage.value = page;
};
</script>
