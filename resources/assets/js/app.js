
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router';
 
window.Vue.use(VueRouter);
 
import RemindersIndex from './components/reminders/RemindersIndex.vue';
import RemindersCreate from './components/reminders/RemindersCreate.vue';
import RemindersEdit from './components/reminders/RemindersEdit.vue';
 
const routes = [
    {
        path: '/',
        components: {
            remindersIndex: RemindersIndex
        }
    },
    {path: '/admin/reminders/create', component: RemindersCreate, name: 'createReminder'},
    {path: '/admin/reminders/edit/:id', component: RemindersEdit, name: 'editReminder'},
]
 
const router = new VueRouter({ routes })
 
const app = new Vue({ router }).$mount('#app')