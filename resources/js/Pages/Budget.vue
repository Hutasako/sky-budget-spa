<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimeButton from "primevue/button";
import RevenueEstimate from "../Components/RevenueEstimate.vue";

import Column from 'primevue/column';


defineProps({projects: Object})

const labor = ref(25);
const rental = ref(50);

const input = ref(null);
const selectedProjects = ref([]);

const castNumber = (node) => {
  node.hook.input((value, next) => next(Number(value)))
}

const max_sum = (node, max = 100) => {
  return Object.values(node.value).reduce((a, b) => a + b) <= max
}

</script>

<template>
<Head title="Budget Generator" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estimate Entry</h2>
        </template>

        <div class="py-12">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">

                        <DataTable v-model:selection="selectedProjects" :value="projects"  selectionMode="multiple" dataKey="id">
                            <Column selectionMode="multiple" headerStyle="width: 3rem"></Column>
                            <template #header>
                                    <h2 class=" font-semibold text-xl leading-tight">Projects Carryover - 2024</h2>
                                    <h3>Select projects that will carryover to the next year.</h3>
                            </template>
                            <Column field="project_number" header="Project Number"></Column>
                            <Column field="project_name" header="Project Name"></Column>
                            <Column field="customer_name" header="Customer Name"></Column>
                            <Column field="net_revenue" header="2023 Net Revenue"></Column>
                            <!-- <Column header="Revenue Estimate">
                                <template #body="dataProps">
                                    <RevenueEstimate :laborRate="labor" v-model:labor="rental"/>
                                    <div class="grid grid-cols-4 gap-4">
                                    <InputText :id="`input_${dataProps.data.id}`" v-model="value" class="w-full mb-3" />
                                    <input v-model="value" type="range" />
                                    <input type="text" ref="input" />
                                    {{ dataProps.data.id }}
                                    </div>
                                </template>
                            </Column> -->
                        </DataTable>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    <DataTable :value="selectedProjects">
                        <template #header>
                                    <h2 class=" font-semibold text-xl leading-tight">Revenue estimate</h2>
                                    <h3>Enter the projected total revenue and the % breakdown.</h3>
                            </template>
                        <Column field="project_number" header="Project Number"></Column>
                        <Column field="project_name" header="Project Name"></Column>
                        <Column field="customer_name" header="Customer Name"></Column>
                        <Column header="Revenue estimate">
                            <template #body>
                                <FormKit
                                type="form"
                                :plugins="[castNumber]"
                                #default = "{ value }"
                                >

                                    <FormKit type="text" label="Revenue estimate"/>

                                    <FormKit
                                    type="group"
                                    name="breakdown"
                                    id="breakdown"
                                    :validation-rules="{max_sum}"
                                    validation-visibility="live"
                                    validation="max_sum"
                                    :validation-messages="{
                                        max_sum: ({ name, args }) => `${name} has exceeded the max budget of 100.`,
                                    }"
                                    #default="{ id, messages, fns, classes }"
                                    >
                                        <FormKit type="number"
                                        label="Labor revenue %"
                                        value="20"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        label="Rental revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        label="Sales revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        label="Other revenue %"
                                        value="25"
                                        step="1"
                                        />

                                        <ul :class="classes.messages" v-if="fns.length(messages)">
                                        <li
                                            v-for="message in messages"
                                            :key="message.key"
                                            :class="classes.message"
                                            :id="`${id}-${message.key}`"
                                            :data-message-type="message.type"
                                        >
                                            {{ message.value }}
                                        </li>
                                        </ul>
                                    </FormKit>
                                </FormKit>

                            </template>

                        </Column>
                    </DataTable>
                    </div>
                </div>
            </div>
        </div>
</AuthenticatedLayout>
</template>
