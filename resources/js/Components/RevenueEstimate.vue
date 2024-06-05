<script setup>
import { ref } from 'vue'
import InputText from 'primevue/inputtext';

const props = defineProps({'laborRate': Number})
const value = ref(props.laborRate);
const rentalModel = defineModel('labor');

</script>
<template>

    <div class="grid grid-cols-4 gap-4">
        <div class="">
            <InputText v-model="value" class="w-full mb-3" />
            <input v-model="value" type="range" />
        </div>
        <div class="">
            <InputText v-model="rentalModel" class="w-full mb-3" />
            <input v-model="rentalModel" type="range" />
        </div>
        <div class="">
            <InputText v-model="value" class="w-full mb-3" />
            <input v-model="value" type="range" />
        </div>
        <div class="">
            <InputText v-model="value" class="w-full mb-3" />
            <input v-model="value" type="range" />
        </div>
    </div>
    <!-- <div class="flex flex-row">

        <div>
            <input type="range" />
        </div>
        <div>
            <input type="range" />
        </div>
        <div>
            <input type="range" />
        </div>
        <div>
            <input type="range" />
        </div>
    </div> -->


</template>
