<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimeButton from "primevue/button";


import DataTable from 'primevue/datatable';
import Column from 'primevue/column';

defineProps({projects: Object})

</script>

<template>
<Head title="Budget Generator" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estimate Entry</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <DataTable :value="projects" class=" text-gray-100">
                            <template #header>
                                <div class="bg-gray-400 p-6">
                                    <h2 class=" font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Projects</h2>
                                </div>
                            </template>
                            <Column field="project_number" header="Project Number"></Column>
                            <Column field="project_name" header="Project Name"></Column>
                            <Column field="customer_name" header="Customer Name"></Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
