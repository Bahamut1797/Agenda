
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./notify.min');
 
window.Vue = require('vue');

import * as VueGoogleMaps from 'vue2-google-maps'
window.Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyAENdWcoLuX90NCaHxtNMDDdLjx2hZIIJ4',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)
  }
})

import VueRouter from 'vue-router';
 
window.Vue.use(VueRouter);
 
import RemindersIndex from './components/reminders/RemindersIndex.vue';
import RemindersSecret from './components/reminders/RemindersSecret.vue';
import RemindersCreate from './components/reminders/RemindersCreate.vue';
import RemindersEdit from './components/reminders/RemindersEdit.vue';

var text = "/";
var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  
for (var i = 0; i < 11; i++){
    text += possible.charAt(Math.floor(Math.random() * possible.length));
}
 
const routes = [
    {
        path: '/',
        components: {
            remindersIndex: RemindersIndex
        },
        name: 'remindersIndex'
    },
    {path: text, component: RemindersSecret, name: 'remindersSecret'},
    {path: '/create', component: RemindersCreate, name: 'createReminder'},
    {path: text + '/edit/:id', component: RemindersEdit, name: 'editReminder'},
]
 
const router = new VueRouter({ routes })
 
const app = new Vue({ router }).$mount('#app')