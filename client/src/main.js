import './assets/main.css'

import { createApp } from 'vue'
import App from './App.vue'
import './index.css'
import router from './router'
import AOS from 'aos';
import 'aos/dist/aos.css';
import '@schedule-x/theme-default/dist/index.css';

AOS.init();
const app = createApp(App)

app.use(router)

app.mount('#app')




import store from './store'; // Import your Vuex store
 

app.use(router); // Use the router in your Vue app
app.use(store); // Use the Vuex store in your Vue app


