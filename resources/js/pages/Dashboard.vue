<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import { BreadcrumbItem } from '@/types';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    }
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Dashboard" />
        <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Dashboard page</h1>
    </div>
    </AppLayout>
</template>
