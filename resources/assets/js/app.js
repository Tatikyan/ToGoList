
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');

 import VueAxios from 'vue-axios';
 import axios from 'axios';
 import leftSidebar from './components/sidebars/leftSidebar'
 import Places from './pages/Places.vue';
 import EditMarkers from './components/popups/EditMarkers.vue';

 Vue.use(VueAxios, axios);
 /*
 we should use all component names in lower case because browser changes it automatically in html
 */
 Vue.component('togolist-places', Places);
 Vue.component('edit-markers', EditMarkers);
 Vue.component('left-sidebar', leftSidebar);   

// app Vue instance
 const app =
    new Vue({
    el: '#app',
        // app initial state
        data: {
            showModal: false,
            places: [],
            markers: [],
            position: {},
            map: {}
        }
});
