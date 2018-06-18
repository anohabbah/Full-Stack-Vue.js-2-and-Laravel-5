import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.user(VueRouter);

import HomePage from '../components/HomePage';
import ListingPage from '../components/ListingPage';

export default new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/listings/:listing', component: ListingPage, name: 'listings'},
    ]
});
