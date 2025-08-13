<template>
    <div class="space-y-24 px-4 py-6">
        <div class="grid grid-cols-1 gap-y-2 md:grid-cols-4 md:gap-x-4">
            <div
                class="status flex min-h-28 flex-col justify-center space-y-2 rounded-md bg-semi-black pl-4 text-white">
                <Icon icon-name="mdiAccount" size="26" color="#ffffff" />
                <div class="flex">
                    <span class="pr-2 font-inter text-base">Total</span><span>{{ userStatus?.totalUser }}</span>
                </div>
            </div>
            <div
                class="status flex min-h-28 flex-col justify-center space-y-2 rounded-md bg-semi-black pl-4 text-white">
                <Icon icon-name="mdiAccountCheck" size="26" color="#ffffff" />
                <div class="flex">
                    <span class="pr-2 font-inter text-base">Active</span><span>{{ userStatus?.activeUser }}</span>
                </div>
            </div>
            <div
                class="status flex min-h-28 flex-col justify-center space-y-2 rounded-md bg-semi-black pl-4 text-white">
                <Icon icon-name="mdiAccountCancel" size="26" color="#ffffff" />
                <div class="flex">
                    <span class="pr-2 font-inter text-base">In Active</span><span>{{ userStatus?.inActiveUser }}</span>
                </div>
            </div>
            <div
                class="status flex min-h-28 flex-col justify-center space-y-2 rounded-md bg-semi-black pl-4 text-white">
                <Icon icon-name="mdiShieldCrown" size="26" color="#ffffff" />
                <div class="flex">
                    <span class="pr-2 font-inter text-base">Admin</span><span>{{ userStatus?.adminUser }}</span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1">
            <WhenVisible data="logHistoryByDate">
                <template #fallback>
                    <div class="flex items-center justify-center h-64">
                        <span class="text-gray-500">Loading...</span>
                    </div>
                </template>                  
                <DateChart :graphData="logHistoryByDate" />              
            </WhenVisible>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-2">
            <div>
                <WhenVisible data="logHistoryByMonth">
                    <template #fallback>
                        <div class="flex items-center justify-center h-64">
                            <span class="text-gray-500">Loading...</span>
                        </div>
                    </template>                  
                    <MonthChart :graphData="logHistoryByMonth" />              
                </WhenVisible>              
            </div>
            <div>
                <WhenVisible data="logHistoryByYear">
                    <template #fallback>
                        <div class="flex items-center justify-center h-64">
                            <span class="text-gray-500">Loading...</span>
                        </div>
                    </template>                  
                    <YearChart :graphData="logHistoryByYear" />             
                </WhenVisible>               
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 md:gap-x-2">
            <div>
                <WhenVisible data="roleWiseUser">
                    <template #fallback>
                        <div class="flex items-center justify-center h-64">
                            <span class="text-gray-500">Loading...</span>
                        </div>
                    </template>                  
                    <RoleChart :graphData="roleWiseUser" />            
                </WhenVisible>                
            </div>
            <div>
                <WhenVisible data="logHistoryByBrowser">
                    <template #fallback>
                        <div class="flex items-center justify-center h-64">
                            <span class="text-gray-500">Loading...</span>
                        </div>
                    </template>                  
                    <BrowserChart :graphData="logHistoryByBrowser" />            
                </WhenVisible>
            </div>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {Deferred,WhenVisible} from '@inertiajs/vue3'
import Root from '../Layouts/root.vue';
import Icon from '../Components/helper/Icon.vue';
import DateChart from '../Components/charts/DateChart.vue';
import MonthChart from '../Components/charts/MonthChart.vue';
import YearChart from '../Components/charts/YearChart.vue';
import RoleChart from '../Components/charts/RoleChart.vue';
import BrowserChart from '../Components/charts/BrowserChart.vue';
defineOptions({ layout: Root });

interface Props {
    userStatus: {
        totalUser: number;
        activeUser: number;
        inActiveUser: number;
        adminUser: number;
    };
    logHistoryByDate: {
        date: string;
        count: number;
    }[];
    logHistoryByMonth: {
        month: string;
        count: number;
    }[];
    logHistoryByYear: {
        year: string;
        count: number;
    }[];
    roleWiseUser: {
        roleName: string;
        count: number;
    }[];
    logHistoryByBrowser: {
        browser: string;
        count: number;
    }[];
}
defineProps<Props>()
</script>