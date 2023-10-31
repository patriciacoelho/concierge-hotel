import ListRooms from '../pages/ListRooms.vue';

export const routes = [
	{
		label: 'Rooms',
		name: 'rooms',
		path: '/rooms',
		component: ListRooms,
		meta: {
			description: 'Rooms',
		},
	},
];

export default routes;
