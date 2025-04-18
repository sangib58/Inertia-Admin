<template>
    <div class="px-4 py-6">
        <div class="flex justify-end">
            <button @click.stop="openAdd"
                class="cursor-pointer mb-1 rounded bg-dark-gray px-3 py-1.5 text-sm text-white hover:bg-dark-black disabled:bg-gray-300">
                Add User
            </button>
        </div>
        <table class="min-w-full border-collapse rounded-md border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Name
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Role
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Mobile
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Email
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Date Of Birth
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in paginatedData" :key="item.userId" class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.fullName }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.roleName }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.mobile }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.email }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.dateOfBirth }}
                    </td>
                    <td class="flex space-x-1 px-4 py-2">
                        <span class="cursor-pointer" @click.stop="openEdit(item)">
                            <Icon icon-name="mdiPencil" size="18" color="#3a484a" />
                        </span>
                        <span class="cursor-pointer" @click.stop="openDelete(item)">
                            <Icon icon-name="mdiDelete" size="18" color="#3a484a" />
                        </span>
                    </td>
                </tr>
                <tr v-if="paginatedData.length === 0">
                    <td colspan="3" class="px-4 py-2 text-center text-sm text-gray-500">
                        No data available.
                    </td>
                </tr>
            </tbody>
        </table>
        <TableFooter :total-items="props.userList.length" :items-per-page="itemsPerPage" :current-page="currentPage"
            @current-page-change="updateCurrentPage" />
        <AddEdit v-if="showAddEdit" :show="showAddEdit" :obj="objUser" :roles="roleList" @close="closeAddEdit" />
        <Delete v-if="showDelete" :show="showDelete" :id="userId" @close="closeDelete" />
    </div>
</template>

<script lang="ts" setup>
import AddEdit from '../../Components/user/AddEdit.vue';
import Delete from '../../Components/user/Delete.vue';
import TableFooter from '../../Components/helper/TableFooter.vue';
import Root from '../../Layouts/root.vue'
import Icon from '../../Components/helper/Icon.vue';
import { ref, computed } from 'vue';
defineOptions({ layout: Root });

interface User {
    userId: number;
    fullName: string;
    mobile: string;
    email: string;
    roleName: string;
    dateOfBirth: Date,
    imagePath: string | null,
}
interface Role {
    userRoleId: number;
    roleName: string;
}
interface Props {
    userList: User[],
    roleList: Role[]
}
const props = defineProps<Props>();
const itemsPerPage = ref(5);
const currentPage = ref(1);
const showDelete = ref(false);
const showAddEdit = ref(false);
const userId = ref(0);
const objUser = ref({});

const openAdd = () => {
    objUser.value = {};
    showAddEdit.value = !showAddEdit.value;
};

const openEdit = (item: User) => {
    objUser.value = item;
    showAddEdit.value = !showAddEdit.value;
};

const closeAddEdit = (confirmed: boolean) => {
    showAddEdit.value = confirmed;
};

const openDelete = (item: User) => {
    showDelete.value = !showDelete.value;
    userId.value = item.userId;
};

const closeDelete = (confirmed: boolean) => {
    showDelete.value = confirmed;
};

//get paginated data
const paginatedData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.userList.slice(start, end);
});

//current page number update
const updateCurrentPage = (page: number) => {
    currentPage.value = page;
};


</script>