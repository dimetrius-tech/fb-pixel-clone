<script setup lang="ts">
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import { computed, onMounted, ref } from 'vue';
import { Bar } from 'vue-chartjs';

const {userActivitiesCount} = defineProps<{
    userActivitiesCount: [];
}>();

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const views = ref(userActivitiesCount);

const pixelViewCounter = computed(() => {
    return views.value.filter(v => v.referrer === 'http://localhost/pixel-view').length;
})
const dashboardViewCounter = computed(() => {
    return views.value.filter(v => v.referrer === 'http://localhost/dashboard').length;
})

const chartData = computed(() => ({
    labels: [ 'Activity' ],
    datasets: [
        {
            label: 'Pixel-view page visit',
            data: [pixelViewCounter.value],
            backgroundColor: '#f87979',
        },
        {
            label: 'Dashboard page visit',
            data: [dashboardViewCounter.value],
            backgroundColor: '#f47929',
        }
    ]
}));
const chartOptions = {
    responsive: true
};

onMounted(() => {
    Echo.join('pixel')
        .error((error) => {
            console.error('Echo error:', error);
        })
        .listen('.PageViewed', (event) => {
            views.value.push(event.pageView);
        });
})
</script>

<template>
    <div>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Live Page Visits</h1>
            <h1 class="text-2xl font-bold mb-4">Count: {{views.length}}</h1>
            <div class="max-w-4xl mx-auto">
                <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="chartData"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
