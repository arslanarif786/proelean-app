require('./bootstrap');

import { createApp } from 'vue'
import axios from 'axios'
import router from './router/routes'
import App from './layout/app'


const app=new createApp({
    components: {App},
}).use(router).mount('#app');
