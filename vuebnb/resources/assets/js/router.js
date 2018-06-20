import Vue from 'vue';
import axios from 'axios';
import store from './store';

import VueRouter from 'vue-router';
import HomePage from '../components/HomePage.vue';
import ListingPage from '../components/ListingPage.vue';
import SavedPage from '../components/SavedPage.vue';
import LoginPage from '../components/LoginPage.vue';

Vue.use(VueRouter);

let router = new VueRouter({
    mode: 'history',
    routes: [
        {path: '/', component: HomePage, name: 'home'},
        {path: '/listings/:listing', component: ListingPage, name: 'listings'},
        {path: '/saved', component: SavedPage, name: 'saved'},
        {path: '/login', component: LoginPage, name: 'login'}
    ],
    scrollBehavior(to, from, savedPosition) {
        return {x: 0, y: 0}
    }
});

router.beforeEach((to, from, next) => {
    let serverData = JSON.parse(window.vuebnb_server_data);
    if (
        to.name === 'listings'
            ? store.getters.getListing(to.params.listing)
            : store.state.listing_summaries.length > 0
            || to.name === 'login'
    ) {
        next();
    }
    else if (!serverData.path || to.path !== serverData.path) {
        let url = to.name !== 'home' ? `${window.app_url}api${to.path}` : `${window.app_url}api`;
        axios.get(url).then(({data}) => {
            store.commit('addData', {route: to.name, data});
            next();
        });

    }
    else {
        store.commit('addData', {route: to.name, data: serverData});
        serverData.saved.forEach(id => store.commit('toggleSaved', id));
        next();
    }
});

export default router;
