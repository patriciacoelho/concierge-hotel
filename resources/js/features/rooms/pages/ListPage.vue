<script setup>
import { ref, onMounted } from 'vue';
import RoomsFilters from '../components/RoomsFilters.vue';
import RoomsList from '../components/RoomsList.vue';

const hotels = ref([]);
const rooms = ref([]);
const hotel = ref({});

const getHotels = (params) => axios.get('/hotels', { params })
    .then(({ data }) => {
        hotels.value = data.hotels;
    });

const getRoomsByHotel = (params) => axios.get('/rooms', { params })
    .then(({ data }) => {
        rooms.value = data.rooms;
        hotel.value = data.hotel;
    });

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

    <v-card
        max-width="600"
        :title="hotel.name"
        :subtitle="hotel.location"
    >
        <rooms-list
            :rooms="rooms"
        />
    </v-card>
</template>