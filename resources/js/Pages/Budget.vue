<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimeButton from "primevue/button";
import RevenueEstimate from "../Components/RevenueEstimate.vue";

import Slider from 'primevue/slider';
import InputText from 'primevue/inputtext';

import DataTable from 'primevue/datatable';
import Column from 'primevue/column';


const value = ref(20);
defineProps({projects: Object})

</script>

<template>
<Head title="Budget Generator" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estimate Entry</h2>
        </template>
        <div class="py-12">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <DataTable :value="projects" class="bg-white rounded-lg p-6" selectionMode="multiple" dataKey="id">
                            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                            <template #header>
                                    <h2 class=" font-semibold text-xl leading-tight">Projects Carryover - 2024</h2>
                                    <h3>Select projects that will carryover to the next period.</h3>
                            </template>
                            <Column field="project_number" header="Project Number"></Column>
                            <Column field="project_name" header="Project Name"></Column>
                            <Column field="customer_name" header="Customer Name"></Column>
                            <Column field="net_revenue" header="Net Revenue"></Column>
                            <Column header="Revenue Estimate">
                                <template #body>
                                    <!-- <RevenueEstimate /> -->
                                    <div class="card flex justify-center">
                                        <div class="w-[14rem]">
                                            <!-- <InputText v-model.number="value" class="w-full mb-3" /> -->
                                            <Slider v-model="value" class="w-full" />
                                        </div>
                                    </div>
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
