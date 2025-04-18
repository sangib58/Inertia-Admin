<template>
    <Bar v-if="loaded" :data="chartData" :options="chartOptions" :style="style" />
</template>

<script lang="ts" setup>
import { Bar } from "vue-chartjs";
import { computed, onMounted, ref } from "vue";
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    ChartData,
    ChartOptions,
} from "chart.js";
ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
);
const loaded = ref(false);
const chartData = ref<ChartData<'bar'>>({
    labels: [],
    datasets: [],
});
const chartOptions = ref<ChartOptions<'bar'>>({
    responsive: true,
    maintainAspectRatio: true,
});
const style = computed(() => {
    return {
        height: "400px",
        width: "600px",
        position: "relative",
    };
});

interface GraphItem {
    browser: string,
    count: number
}

const props = defineProps<{
    graphData: GraphItem[]
}>()

onMounted(() => {
    chartData.value = {
        labels: props.graphData.map((x) => x.browser),
        datasets: [
            {
                label: "Login(Browser Wise)",
                backgroundColor: "#212121",
                data: props.graphData.map((x) => x.count),
            },
        ],
    };
    loaded.value = true;
})
</script>