<script setup>
import { ref, reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Column from 'primevue/column';
import Divider from 'primevue/divider';

defineProps({projects: Object})

const labor = ref(25);
const rental = ref(50);

const input = ref(null);
const selectedProjects = ref([]);
const estimations = ref([]);
const max_sum = (node, max = 100) => {
  return Object.values(node.value).reduce((a, b) => Number(a) + Number(b)) <= max
}
const form = reactive({
    user_id: null,
    projects: [],
})
</script>


<template>
<Head title="Budget Generator" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estimate Entry</h2>
        </template>

        <div class="py-12">
            <div class="max-w-12xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-slate-200 shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 ">

                        <DataTable v-model:selection="selectedProjects" :value="projects"  selectionMode="multiple" dataKey="id">
                            <Column selectionMode="multiple" headerStyle="width: 3rem"  class="border-black"></Column>
                            <template #header>
                                    <h2 class=" font-semibold text-xl leading-tight">Projects Carryover - 2024</h2>
                                    <h3>Select projects that will carryover to the next year.</h3>
                            </template>
                            <Column field="project_number" header="Project Number"  class="border-black"></Column>
                            <Column field="project_name" header="Project Name"  class="border-black"></Column>
                            <Column field="customer_name" header="Customer Name"  class="border-black"></Column>
                            <Column field="net_revenue" header="2023 Net Revenue"  class="border-black"></Column>
                        </DataTable>
                    </div>
                </div>
                <div class="bg-slate-200 shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                    <DataTable :value="selectedProjects" dataKey="id">
                        <template #header>
                                <h2 class=" font-semibold text-xl leading-tight">Projects Estimate Entry</h2>
                                <h3>Enter your potential projects going into the next year.</h3>
                        </template>
                        <Column header="Project Name" class="border-black">
                            <template #body="dataProps">
                                <div >
                                    {{ dataProps.data.project_name}}

                                    <span v-tooltip.top="{
                                                    value: `${dataProps.data.project_number}`,
                                                    pt: {
                                                        arrow: {
                                                            class: ['bg-slate-200']
                                                        },
                                                        text: ['bg-primaryfont-medium', 'p-2', 'bg-slate-200', 'rounded-md', 'ring-2'],
                                                    }
                                                }" class="pi pi-question-circle" style="color: silver"></span>
                                </div>
                                </template>
                        </Column>

                        <Column field="customer_name" header="Customer Name"  class="border-black"></Column>
                        <Column field="segment" header="Segment"  class="border-black"></Column>
                        <Column class="flex flex-row border-black" headerClass="custom-class">
                            <template #header ">
                                <div class="m-auto">
                                    <h2>Estimate</h2>
                                </div>
                            </template>
                            <template #body>
                                <div class="m-auto flex flex-row">

                                    <FormKit outer-class="mx-6" input-class=" rounded" type="text" label="Revenue ($)"/>
                                    <FormKit
                                    type="group"
                                    name="Revenue breakdown"
                                    id="breakdown"
                                    :validation-rules="{max_sum}"
                                    validation-visibility="live"
                                    validation="max_sum"
                                    :validation-messages="{
                                        max_sum: ({ name, args }) => `Total ${name} cannot be greater than 100%.`,
                                    }"
                                    #default="{ id, messages, fns, classes }"
                                    >
                                        <FormKit type="number"
                                        outer-class="mx-6"
                                        input-class="w-32 rounded"
                                        label="Labor revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        outer-class="mx-6"
                                        input-class="w-32 rounded"
                                        label="Rental revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        outer-class="mx-6"
                                        input-class="w-32 rounded"
                                        label="Sales revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <FormKit type="number"
                                        outer-class="mx-6"
                                        input-class="w-32 rounded"
                                        label="Other revenue %"
                                        value="25"
                                        step="1"
                                        />
                                        <span  v-if="fns.length(messages)" v-tooltip.top="{
                                                    value: `${dataProps.data.project_number}`,
                                                    pt: {
                                                        arrow: {
                                                            class: ['bg-slate-200']
                                                        },
                                                        text: ['bg-primaryfont-medium', 'p-2', 'bg-slate-200', 'rounded-md', 'ring-2'],
                                                    }
                                                }" class="pi pi-question-circle" style="color: silver"></span>
                                        <ul v-if="fns.length(messages)">
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
<style>
    .custom-class > div[data-pc-section="headercontent"] {
        width: 100%;
    }
</style>
