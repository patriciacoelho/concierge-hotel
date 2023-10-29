import './bootstrap';

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Vuetify
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import { aliases, md } from 'vuetify/iconsets/md';

import App from './App.vue';
import ListRooms from './features/rooms/pages/ListRooms.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/rooms', component: ListRooms },
    ],
});

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'md',
        aliases,
        sets: {
            md,
        },
    },
});

const app = createApp(App);

app.use(router);
app.use(vuetify);

app.mount("#app");
