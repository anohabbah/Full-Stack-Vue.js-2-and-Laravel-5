import Vue from 'vue';
import sample from './data';

const app = new Vue({
    el: '#app',
    data: {
        title: sample.title,
        address: sample.address,
        about: sample.about,
        headerImageStyle: {
            'background-image': 'url(images/header.jpg)'
        },
        amenities: sample.amenities,
        prices: sample.prices,
        contracted: true,
        modalOpen: false
    },
    watch: {
        modalOpen: function (newValue) {
            const className = 'modal-open';
            newValue ? document.body.classList.add(className) : document.body.classList.remove(className);
        }
    },
    methods: {
        escapeKeyListener: function (evt) {
            if (evt.keyCode === 27 && this.modalOpen) {
                this.modalOpen = false;
            }
        }
    },
    created: function () {
        document.addEventListener('keyup', this.escapeKeyListener);
    },
    destroy: function () {
        document.removeEventListener('keyup', this.escapeKeyListener);
    }
});
