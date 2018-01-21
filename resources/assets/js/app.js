
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import leftSidebar from './components/sidebars/leftSidebar'
 import Places from './pages/Places.vue';
 import EditMarkers from './components/popups/EditMarkers.vue';

 Vue.component('togolist-places', Places);
 Vue.component('edit-markers', EditMarkers);
 Vue.component('left-sidebar', leftSidebar);

 const app =
    new Vue({
    el: '#app',
        data: {
            showModal: false
        }
});
