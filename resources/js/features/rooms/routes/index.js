import ListPage from '../pages/ListPage.vue';

export const routes = [
	{
		label: 'Rooms',
		name: 'rooms',
		path: '/rooms',
		component: ListPage,
		meta: {
			description: 'Rooms',
		},
	},
];

export default routes;
