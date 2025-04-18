<template>
    <div class="px-4 py-6">
        <div class="flex justify-end">
            <button @click.stop="openAdd"
                class="mb-1 rounded cursor-pointer bg-dark-gray px-3 py-1.5 text-sm text-white hover:bg-dark-black disabled:bg-gray-300">
                Add Faq
            </button>
        </div>
        <table class="min-w-full border-collapse rounded-md border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Title
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Description
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in paginatedData" :key="item.faqId" class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.title }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.description }}
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
        <TableFooter :total-items="faqs.length" :items-per-page="itemsPerPage" :current-page="currentPage"
            @current-page-change="updateCurrentPage" />
        <AddEdit v-if="showAddEdit" :show="showAddEdit" :obj="objFaq" @close="closeAddEdit" />
        <Delete v-if="showDelete" :show="showDelete" :id="faqId" @close="closeDelete" />
    </div>
</template>

<script lang="ts" setup>
import { computed, ref } from "vue";
import Root from '../Layouts/root.vue';
import Icon from "../Components/helper/Icon.vue";
import AddEdit from "../Components/faq/AddEdit.vue";
import Delete from "../Components/faq/Delete.vue";
import TableFooter from '../Components/helper/TableFooter.vue';
defineOptions({ layout: Root })

interface Faq {
    faqId: number;
    title: string;
    description: string;
}
interface Props {
    faqs: Faq[];
}
const props = defineProps < Props > ()
const itemsPerPage = ref(5);
const currentPage = ref(1);
const showDelete = ref(false);
const showAddEdit = ref(false);
const faqId = ref(0);
const objFaq = ref({});

const openAdd = () => {
    objFaq.value = {};
    showAddEdit.value = !showAddEdit.value;
};

const openEdit = (item: Faq) => {
    objFaq.value = item;
    showAddEdit.value = !showAddEdit.value;
};

const closeAddEdit = (confirmed: boolean) => {
    showAddEdit.value = confirmed;
};

const openDelete = (item: Faq) => {
    showDelete.value = !showDelete.value;
    faqId.value = item.faqId;
};

const closeDelete = (confirmed: boolean) => {
    showDelete.value = confirmed;
};

//get paginated data
const paginatedData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.faqs.slice(start, end);
});

//current page number update
const updateCurrentPage = (page: number) => {
    currentPage.value = page;
};
</script>