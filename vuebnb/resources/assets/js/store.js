import Vue from 'vue';
import VueX from 'vuex';
import router from './router';
import axios from 'axios';

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token
};

Vue.use(VueX);

export default new VueX.Store({
    state: {
        saved: [],
        listings: [],
        listing_summaries: [],
        auth: false
    },
    mutations: {
        toggleSaved(state, id) {
            const index = state.saved.findIndex(s => s === id);
            index === -1 ? state.saved.push(id) : state.saved.splice(index, 1)
        },
        addData(state, {route, data}) {
            if (data.auth) {
                state.auth = data.auth;
            }
            if (route === 'listings') {
                state.listings.push(data.listing);
            } else {
                state.listing_summaries = data.listings;
            }
        }
    },
    actions: {
        toggleSaved({commit, state}, id) {
            if (state.auth) {
                axios.post('/api/user/saved', {id}).then(() => commit('toggleSaved', id))
            } else {
                router.push('/login');
            }
        }
    },
    getters: {
        listingSummaries(state) {
            return state.listing_summaries.filter(item => state.saved.indexOf(item.id) > -1);
        },
        getListing(state) {
            return id => state.listings.find(listing => id === listing.id);
        }
    }
});
