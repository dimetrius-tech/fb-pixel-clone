<script setup lang="ts">
import { BarElement, CategoryScale, Chart as ChartJS, Legend, LinearScale, Title, Tooltip } from 'chart.js';
import { computed, onMounted, ref } from 'vue';
import { Bar } from 'vue-chartjs';
import {Select, SelectTrigger, SelectValue, SelectContent, SelectItem} from '@/components/ui/select';

const {userActivitiesCount} = defineProps<{
    userActivitiesCount: [];
    usersList: [];
}>();

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const views = ref(userActivitiesCount);

const liveHits = ref([]);

const userActivity = computed(() => {
    if(chosenUser.value !== 0) {
        return views.value.filter(v => v.user_id === chosenUser.value);
    } else {
        return [];
    }
})

const remoteActivity = computed(() => {
    return views.value.filter(v => v.user_id === null);
})

const chosenUser = ref<number>(0);

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
            liveHits.value.push(event.pageView);
        });
})
const dateConverter = (date: string) => {
    const dateInstance = new Date(date);
    return dateInstance.toLocaleDateString("en-GB", {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false,
        timeZone: 'UTC'
    });
}
</script>

<template>
    <div>
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-4">Live Page Visits</h1>
            <div>
                <h1>Users</h1>
                <Select v-model="chosenUser">
                    <SelectTrigger>
                        <SelectValue placeholder="Choose one" />
                    </SelectTrigger>
                    <SelectContent class="w-56">
                        <SelectItem
                            v-for="user in usersList"
                            :key="user.id"
                            :value="user.id"
                        >
                            {{user.name}}
                        </SelectItem>
                    </SelectContent>
                </Select>
            </div>
            <div class="grid grid-cols-4 gap-6">
                <div>
                    <h1> User's Live hits list:</h1>
                    <ul v-if="userActivity.length > 0">
                        <li v-for="live in userActivity" :key="live.id">
                            {{live.referrer}} - {{dateConverter(live.created_at)}}
                        </li>
                    </ul>
                </div>
                <div>
                    <h1>Remote activity</h1>
                    <ul>
                        <li v-for="remote in remoteActivity" :key="remote.id">
                            {{remote.referrer}} - {{dateConverter(remote.created_at)}}
                        </li>
                    </ul>
                </div>
                <div class="mx-auto col-span-2 w-full">
                    <Bar
                        id="my-chart-id"
                        :options="chartOptions"
                        :data="chartData"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
