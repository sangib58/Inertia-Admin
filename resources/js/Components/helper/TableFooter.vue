<template>
    <div class="mt-4 flex items-center justify-center space-x-4">
        <button
            class="rounded cursor-pointer bg-dark-gray px-3 py-1 text-sm text-white hover:bg-dark-black disabled:bg-gray-300"
            :disabled="currentPage === 1" @click="goToPage(currentPage - 1)">
            Previous
        </button>
        <span class="text-sm text-gray-600">
            Page {{ currentPage }} of {{ totalPages }}
        </span>
        <button
            class="rounded cursor-pointer bg-dark-gray px-3 py-1 text-sm text-white hover:bg-dark-black disabled:bg-gray-300"
            :disabled="currentPage === totalPages" @click="goToPage(currentPage + 1)">
            Next
        </button>
    </div>
</template>

<script lang="ts" setup>
import { computed } from 'vue';

interface Props {
    totalItems: number;
    itemsPerPage: number;
    currentPage: number;
}
const props = defineProps<Props>();
const emits = defineEmits<{
    (e: "current-page-change", value: number): void
}>();

//calculate total page
const totalPages = computed<number>(() =>
    Math.ceil(props.totalItems / props.itemsPerPage),
);

// Emit page change event
const goToPage = (page: number): void => {
    if (page > 0 && page <= totalPages.value) {
        emits("current-page-change", page);
    }
};
</script>