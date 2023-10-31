<script setup>
import { ref, onMounted } from 'vue';
import RoomsFilters from '../components/RoomsFilters.vue';
import RoomsList from '../components/RoomsList.vue';

const hotels = ref([]);
const rooms = ref([]);
const hotel = ref({});
const loading = ref(false);
const error = ref(false);

const getHotels = (params) => axios.get('/hotels', { params })
    .then(({ data }) => {
        hotels.value = data.hotels;
    });

const getRoomsByHotel = (params) => {
    error.value = false;
    loading.value = true;
    axios.get('/rooms', { params })
        .then(({ data }) => {
            rooms.value = data.rooms;
            hotel.value = data.hotel;
        })
        .catch(() => error.value = true)
        .finally(() => loading.value = false);
}

onMounted(() => {
    getHotels();
    getRoomsByHotel({ hotel_id: 5, initial_date: '2023-11-29', final_date: '2023-11-30' });
});
</script>

<template>
    <div class="mt-4 mb-6">
        <h4 class="text-h4 text-blue-grey-darken-4">
            Rooms List
        </h4>
        <p class="text-subtitle-1 text-blue-grey-darken-1">
            Search rooms available for hotel in a specific date or interval
        </p>
    </div>
    <rooms-filters
        :hotels="hotels"
        @submit="getRoomsByHotel"
    />

    <v-progress-circular
        v-if="loading"
        class="d-flex mx-auto my-12"
        :size="70"
        :width="7"
        indeterminate
        color="indigo"
    />

    <v-alert
        v-else-if="error"
        variant="outlined"
        type="error"
        border="top"
        prominent
    >
        Oops! Something went wrong. If you're experiencing a critical issue, please email support.
    </v-alert>

    <v-card
        v-else
        max-width="600"
        :title="hotel.name"
        :subtitle="hotel.location"
    >
        <v-alert
            v-if="!rooms.length"
            variant="outlined"
            type="warning"
            border="top"
            prominent
        >
            There is no rooms for selected filters
        </v-alert>
        <rooms-list
            v-else
            :rooms="rooms"
        />
    </v-card>
</template>