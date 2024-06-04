<script setup>
import { ref } from 'vue'
import Slider from 'primevue/slider';
import InputText from 'primevue/inputtext';

</script>
<template>

            <div>
                <InputText v-model.number="value" />
                <Slider name="revEstimate" type="number" placeholder="Enter revenue estimate"/>
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
