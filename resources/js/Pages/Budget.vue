<script setup>
import { ref, reactive } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Button from 'primevue/button';
import Column from 'primevue/column';
import Dialog from 'primevue/dialog';
import Stepper from 'primevue/stepper';
import StepperPanel from 'primevue/stepperpanel';

defineProps({projects: Object})

const labor = ref(25);
const rental = ref(50);

const input = ref(null);
const selectedProjects = ref([]);
const enteredProjects = ref([]);
const estimations = ref([]);

const showAddEntry = ref(false);

const max_sum = (node, max = 100) => {
  return Object.values(node.value).reduce((a, b) => Number(a) + Number(b)) <= max
}

const form = reactive({
    user_id: null,
    selected_projects: [],
})
</script>


<template>
<Head title="Budget Generator" />
<AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Estimate Entry</h2>
        </template>

        <div class="py-12">
            <div class="flex max-w-12xl min-h-96 mx-auto sm:px-6 lg:px-8">
                <div class="bg-slate-200 shadow-sm sm:rounded-lg size-full">
                    <Stepper v-model:activeStep="active">
                        <StepperPanel>
                            <template #header="{ index, clickCallback }">
                                <button class="mr-2 bg-transparent border-none inline-flex flex-col gap-2" @click="clickCallback">
                                    <span :class="[`rounded-full border-2 border-white p-2 inline-flex items-center justify-center`, { 'bg-amber-400 text-white': index <= active, 'border-surface-200 dark:border-surface-700': index > active }]">
                                        <i class="pi pi-user" /> Carryover
                                    </span>
                                </button>
                            </template>
                            <template #content="{ nextCallback }">
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
                                    <div class="flex pt-4 justify-end">
                                        <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                                    </div>
                            </template>
                        </StepperPanel>

                        <StepperPanel>
                            <template #header="{ index, clickCallback }">
                                <button class="mr-2 bg-transparent border-none inline-flex flex- gap-2" @click="clickCallback">
                                    <span :class="[`rounded-full border-2 border-white p-2 inline-flex items-center justify-center`, { 'bg-amber-400 text-white': index <= active, 'border-surface-200 dark:border-surface-700': index > active }]">
                                        <i class="pi pi-user" /> Estimate Entry
                                    </span>
                                </button>
                            </template>
                            <template #content="{  prevCallback, nextCallback }">
                                <DataTable :value="selectedProjects" dataKey="id">
                                    <template #header>
                                            <h2 class=" font-semibold text-xl leading-tight">Projects Estimate Entry</h2>
                                            <h3>Enter your carryover projects revenue going into the next year.</h3>
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
                                <div class="flex pt-4 justify-between">
                                    <Button label="Back" icon="pi pi-arrow-left" @click="prevCallback" />
                                    <Button label="Next" icon="pi pi-arrow-right" iconPos="right" @click="nextCallback" />
                                </div>
                            </template>
                        </StepperPanel>

                        <StepperPanel header="New projects entries">
                            <template #header="{ index, clickCallback }">
                                <button class="bg-transparent border-none inline-flex flex-col gap-2" @click="clickCallback">
                                    <span :class="[`rounded-full border-2 border-white p-2 inline-flex items-center justify-center`, { 'bg-amber-400 text-white': index <= active, 'border-surface-200 dark:border-surface-700': index > active }]">
                                        <i class="pi pi-user" /> New Project Entries
                                    </span>
                                </button>
                            </template>
                            <template #content="{  prevCallback }">
                                <DataTable :value="enteredProjects">
                                    <template #header>
                                        <div class="flex justify-between">
                                            <div>

                                            <h2 class=" font-semibold text-xl leading-tight">Potential revenue</h2>
                                            <h3>Enter your potential projects going into the next year.</h3>
                                        </div>

                                            <Button label="Add Entry" icon="pi pi-plus" @click="showAddEntry = true" />

                                        </div>
                                    </template>
                                    <Column header="Probability"></Column>
                                    <Column header="Project Name"></Column>
                                    <Column header="Customer Name"></Column>
                                    <Column header="Segment"></Column>
                                    <Column header="PO or Contract #"></Column>
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
                                <div class="flex pt-4 justify-between">
                                    <Button label="Back" icon="pi pi-arrow-left" @click="prevCallback" />
                                    <Button label="Submit" icon="pi pi-arrow-right" @click="prevCallback" />
                                </div>
                            </template>

                        </StepperPanel>
                    </Stepper>
                </div>
            </div>
        </div>
        <Dialog v-model:visible="showAddEntry" modal="true" header="Add Project" :style="{ width: '35rem'}" contentClass="p-6">
            <span class="text-surface-600 dark:text-surface-0/70 block mb-5">Update your information.</span>
            <div class="flex items-center gap-3 mb-3">
                <label for="username" class="font-semibold w-[6rem]">Probability</label>
                <InputText id="username" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-3 mb-5">
                <label for="email" class="font-semibold w-[6rem]">Project Name</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-3 mb-5">
                <label for="email" class="font-semibold w-[6rem]">Customer Name</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-3 mb-5">
                <label for="email" class="font-semibold w-[6rem]">Segment</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex items-center gap-3 mb-5">
                <label for="email" class="font-semibold w-[6rem]">PO/Contract #</label>
                <InputText id="email" class="flex-auto" autocomplete="off" />
            </div>
            <div class="flex justify-end gap-2">
                <Button type="button" label="Cancel" severity="secondary" @click="showAddEntry = false"></Button>
                <Button type="button" label="Save" @click="showAddEntry = false"></Button>
            </div>
        </Dialog>
</AuthenticatedLayout>
</template>
<style >
    .custom-class > div[data-pc-section="headercontent"] {
        width: 100%;
    }


    .p-stepper {
        flex-basis: 50rem;
    }

</style>
