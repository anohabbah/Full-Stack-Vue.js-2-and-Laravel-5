import axios from "axios/index";
import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import store from './store';

import HomePage from '../components/HomePage';
import ListingPage from '../components/ListingPage';
import SavedPage from '../components/SavedPage';
import LoginPage from '../components/LoginPage';


const router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/saved', component: SavedPage, name: 'saved'},
        {path: '/listings/:listing', component: ListingPage, name: 'listings'},
        {path: '/login', component: LoginPage, name: 'login'},
    ],
    scrollBehavior(to, from, savedPosition) {
        return {x: 0, y: 0};
    }
});

router.beforeEach((to, from, next) => {
    let serverData = JSON.parse(window.vuebnb_server_data);
    console.log(serverData);
    if(
        to.name === 'listing'
            ? store.getters.getListing(parseInt(to.params.listing))
            : store.state.listing_summaries.length > 0
        || to.name === 'login'
    ) {
        next();
    } else if (!serverData.path || to.path !== serverData.path) {
        axios.get(`/api${to.path}`).then(({data}) => store.commit('addData', {route: to.name, data}));
        next();
    } else {
        store.commit('addData', {route: to.name, data: serverData});
        serverData.saved.forEach(id => store.commit('toggleSaved', id));
        next();
    }
});

export default router;
