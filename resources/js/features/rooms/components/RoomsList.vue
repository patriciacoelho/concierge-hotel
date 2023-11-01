<script setup>
import { DateTime } from 'luxon';

const props = defineProps({
    rooms: {
        type: Array,
        default: () => ([]),
        required: true,
    },
});

const formatDate = (date) => {
    return DateTime.fromSQL(date).toFormat('dd/MM/yyyy');
};

</script>

<template>
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
</template>
