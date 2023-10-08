import './bootstrap';
import { createApp } from "vue/dist/vue.esm-bundler.js";

import SendMessage from './components/SendMessage.vue';
import ChatMessages from './components/ChatMessages.vue';


const  app = createApp({
    components: {
        SendMessage,
        ChatMessages,
    }
});
app.mount('#app');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
