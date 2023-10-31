<script setup>
import { DateTime } from 'luxon';
import { ref, onMounted } from 'vue';

const hotels = ref([]);
const hotel_id = ref(null);
const totalFilter = ref(1);
const initial_date = ref(null);
const final_date = ref(null);
const rooms = ref([]);
const hotel = ref({});

const required = [
    value => {
        if (value) return true

        return 'This field is required.'
    },
];

const formatDate = (date) => {
    return DateTime.fromSQL(date).toFormat('dd/MM/yyyy');
};

const getHotels = (params) => axios.get('/hotels', { params })
    .then(({ data }) => {
        hotels.value = data.hotels;
    });

const getRoomsByHotel = (params) => axios.get('/rooms', { params })
    .then(({ data }) => {
        rooms.value = data.rooms;
        hotel.value = data.hotel;
    });

const handleSearchSubmit = () => {
    const payload = {
        hotel_id: hotel_id.value,
        initial_date: initial_date.value,
        final_date: final_date.value,
        total: totalFilter.value,
    };

    getRoomsByHotel(payload);
};

onMounted(() => {
    getHotels();
    getRoomsByHotel({ hotel_id: 5, initial_date: '2023-11-29', final_date: '2023-11-30' });
});
</script>

<template>
    <div class="mt-4 mb-6">
        <h4 class="text-h4 text-blue-grey-darken-4">Rooms List</h4>
        <p class="text-subtitle-1 text-blue-grey-darken-1">Search rooms available for hotel in a specific date or interval</p>
    </div>
    <v-form @submit.prevent="handleSearchSubmit">
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

    <v-card
        max-width="600"
        :title="hotel.name"
        :subtitle="hotel.location"
    >
        <v-list
            v-for="(room, index) in rooms"
            :key="index"
        >
            <v-list-subheader>
                <v-chip
                    class="ma-2"
                    color="primary"
                    text-color="white"
                >
                    {{ room.type }} room
                </v-chip>
            </v-list-subheader>

            <v-list-item
                v-for="price in room.prices"
                :key="price.date"
                :value="price"
                color="primary"
                variant="plain"
            >
                <v-list-item-title class="ml-4">
                    {{ formatDate(price.date) }}
                </v-list-item-title>

                <template v-slot:append>
                    <span>$ {{ price.value }}</span>
                </template>
            </v-list-item>
        </v-list>
    </v-card>
</template>