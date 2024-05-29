<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import 'primevue/resources/themes/aura-dark-amber/theme.css';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import ColumnGroup from 'primevue/columngroup';   // optional
import Row from 'primevue/row';

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
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <DataTable :value="projects" stripedRows tableStyle="min-width: 50rem">
                            <template #header>
                                <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                                    <span class="text-xl text-900 font-bold">Projects</span>
                                </div>
                            </template>
                            <Column field="project_name" header="Name"></Column>
                            <Column field="project_number" header="Number"></Column>
                            <Column field="customer_name" header="Customer"></Column>
                            <Column field="segment" header="Segment"></Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
