import './bootstrap';

import { createApp } from 'vue';
import StoriesList from './components/StoriesList.vue';

const app = createApp({});
app.component('stories-list', StoriesList);
app.mount('#app');