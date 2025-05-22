<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { LoaderCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button';

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Page Pixel',
        href: '/pixel-view',
    }
]
const form = useForm({
    url: window.location.href,
    referrer: 'submit',
    viewed_at: new Date().toISOString().slice(0, 19).replace('T', ' '),
});
const submit = () => {
};
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Pixel View" />
        <h1>This page is trackable</h1>
        <div class="max-w-xl mx-auto bg-gray-200 p-8">
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="form.processing">
                            <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                            Submit a form
                        </Button>
                    </div>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
