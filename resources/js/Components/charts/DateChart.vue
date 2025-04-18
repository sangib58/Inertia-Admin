<template>
    <Line v-if="loaded" :data="chartData" :options="chartOptions" />
</template>
<script lang="ts" setup>
import { Line } from "vue-chartjs";
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler,
    ChartData,
    ChartOptions, // Import Filler for filling the area under the line
} from "chart.js";
import { onMounted, ref } from "vue";
ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    Filler, // Register Filler
);

interface GraphItem {
    date: string;
    count: number
}
const loaded = ref(false);
const chartData = ref<ChartData<'line'>>({
    labels: [],
    datasets: [],
});
const chartOptions = ref<ChartOptions<'line'>>({
    responsive: true,
    maintainAspectRatio: true,
});
const props = defineProps<{
    graphData: GraphItem[]
}>()

onMounted(() => {
    chartData.value = {
        labels: props.graphData.map((x) => x.date.slice(0, 10)),
        datasets: [
            {
                label: "Login(Date Wise)",
                backgroundColor: "#212121", // Set the fill color with transparency
                borderColor: "#212121", // Set the line color
                data: props.graphData.map((x) => x.count),
                fill: true, // Enable filling the area under the line
                tension: 0.4, // Adjust the tension for a smoother curve
            },
        ],
    };
    loaded.value = true;
})
</script>