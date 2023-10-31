<script setup>
import { ref } from 'vue';

const props = defineProps({
    hotels: {
        type: Array,
        default: () => ([]),
        required: true,
    },
});

const emit = defineEmits(['submit']);

const hotel_id = ref(null);
const totalFilter = ref(1);
const initial_date = ref(null);
const final_date = ref(null);

const required = [
    value => {
        if (value) return true

        return 'This field is required.'
    },
];

const handleFiltersSubmit = () => {
    const payload = {
        hotel_id: hotel_id.value,
        initial_date: initial_date.value,
        final_date: final_date.value,
        total: totalFilter.value,
    };

    emit('submit', payload);
};
</script>

<template>
    <v-form @submit.prevent="handleFiltersSubmit">
        <v-row no-gutters>
            <v-col
                cols="12"
                sm="5"
                md="3"
                class="px-2"
            >
                <v-select
                    v-model="hotel_id"
                    label="Hotel"
                    variant="outlined"
                    persistent-placeholder
                    placeholder="Select a hotel"
                    :rules="required"
                    :items="hotels"
                    item-title="name"
                    item-value="id"
                />
            </v-col>
            <v-col
                cols="12"
                sm="4"
                md="2"
                class="px-2"
            >
                <v-text-field
                    v-model="initial_date"
                    label="Check-in"
                    variant="outlined"
                    persistent-placeholder
                    placeholder="00/00/0000"
                    :rules="required"
                    type="date"
                />
            </v-col>
            <v-col
                cols="12"
                sm="4"
                md="2"
                class="px-2"
            >
                <v-text-field
                    v-model="final_date"
                    label="Check-out"
                    variant="outlined"
                    persistent-placeholder
                    placeholder="00/00/0000"
                    type="date"
                />
            </v-col>
            <v-col
                cols="12"
                sm="3"
                md="1"
                class="px-2"
            >
                <v-text-field
                    v-model="totalFilter"
                    label="No. of rooms"
                    variant="outlined"
                    persistent-placeholder
                    placeholder="1"
                    type="number"
                />
            </v-col>
            <v-col cols="12" sm="3" md="2">
                <v-btn
                    class="text-none"
                    block
                    rounded="lg"
                    size="x-large"
                    variant="flat"
                    color="indigo-darken-3"
                    type="submit"
                >
                    Search
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
</template>
