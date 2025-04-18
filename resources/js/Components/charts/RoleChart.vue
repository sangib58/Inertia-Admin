<template>
    <Pie v-if="loaded" :data="chartData" :options="chartOptions" />
</template>

<script lang="ts" setup>
import { Pie } from "vue-chartjs";
import { Chart as ChartJS, ArcElement, Tooltip, Legend, ChartData, ChartOptions } from "chart.js";
import { onMounted, ref } from "vue";
ChartJS.register(ArcElement, Tooltip, Legend);

interface GraphItem {
    roleName: string;
    count: number
}
const loaded = ref(false);
const chartData = ref<ChartData<'pie'>>({
    labels: [],
    datasets: [],
});
const chartOptions = ref<ChartOptions<'pie'>>({
    responsive: true,
    maintainAspectRatio: false,
});

const props = defineProps<{
    graphData: GraphItem[]
}>()

onMounted(() => {
    chartData.value = {
        labels: props.graphData.map((x) => x.roleName),
        datasets: [
            {
                label: "Login(Role Wise)",
                backgroundColor: "#212121",
                data: props.graphData.map((x) => x.count),
            },
        ],
    };
    loaded.value = true;
})
</script>