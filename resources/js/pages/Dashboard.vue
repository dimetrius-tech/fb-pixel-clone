<script setup lang="ts">
import { ref, onMounted, computed } from 'vue';
import { Bar } from 'vue-chartjs'
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types/index.js';
import { Head } from '@inertiajs/vue3';

const {userActivitiesCount} = defineProps<{
    userActivitiesCount: [];
}>();

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    }
];

const views = ref(userActivitiesCount);
const chartData = computed(() => ({
    labels: [ 'Activity' ],
        datasets: [
        {
            label: 'Visit Counter',
            data: [views.value.filter(v => v.referrer === 'visit').length],
            backgroundColor: '#f87979',
        },
        {
            label: 'Submit Counter',
            data: [views.value.filter(v => v.referrer === 'submit').length],
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
        console.log(event);
        views.value.unshift(event);
    });
})
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Dashboard" />
        <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Live Page Visits</h1>
            <div class="max-w-4xl mx-auto">
                <Bar
                    id="my-chart-id"
                    :options="chartOptions"
                    :data="chartData"
                />
            </div>
    </div>
    </AppLayout>
</template>
