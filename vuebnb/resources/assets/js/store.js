import Vue from 'vue';
import VueX from 'vuex';

Vue.use(VueX);

export default new VueX.Store({
    state: {
        saved: [1, 6, 23, 16],
        listings: [],
        listing_summaries: []
    },
    mutations: {
        toggleSaved(state, id) {
            const index = state.saved.findIndex(s => s === id);
            index === -1 ? state.saved.push(id) : state.saved.splice(index, 1)
        },
        addData(state, {route, data}) {
            if (route === 'listings') {
                state.listings.push(data.listing);
            } else {
                state.listing_summaries = data.listings;
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
