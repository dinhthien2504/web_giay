import { createApp } from 'vue'
import router from './router/index.js'
import './main.css'
import App from './App.vue'

//Bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

const app = createApp(App);
app.use(router);
app.mount('#app');
