<template>
    <div class="px-4 py-6">
        <table class="min-w-full border-collapse rounded-md border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Name
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Email
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Log In Time
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Log Out Time
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        IP
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        Browser
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">
                        OS
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in paginatedData" :key="item.logId" class="border-t hover:bg-gray-50">
                    <td class="px-4 py-2 text-sm text-gray-700">{{ item.fullName }}</td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.email }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.logInTime }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.logOutTime }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.ip }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.browser }}
                    </td>
                    <td class="px-4 py-2 text-sm text-gray-700">
                        {{ item.platform }}
                    </td>
                </tr>
                <tr v-if="paginatedData.length === 0">
                    <td colspan="7" class="px-4 py-2 text-center text-sm text-gray-500">
                        No data available.
                    </td>
                </tr>
            </tbody>
        </table>
        <TableFooter :total-items="logs.length" :items-per-page="itemsPerPage" :current-page="currentPage"
            @current-page-change="updateCurrentPage" />
    </div>
</template>

<script lang="ts" setup>
import { computed, ref } from 'vue';
import Root from '../../Layouts/root.vue';
import TableFooter from '../../Components/helper/TableFooter.vue';
defineOptions({ layout: Root })

interface Log {
    logId: number;
    fullName: string;
    email: string;
    logInTime: string;
    logOutTime: string;
    ip: string;
    browser: string;
    platform: string;
}
interface Props {
    logs: Array<Log>
}
const props = defineProps < Props > ()
const itemsPerPage = ref(10);
const currentPage = ref(1);

//get paginated data
const paginatedData = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return props.logs.slice(start, end);
});

//current page number update
const updateCurrentPage = (page: number) => {
    currentPage.value = page;
};
</script>