<template>
    <div>
        <header-image @header-clicked="openModal" v-if="images[0]" :image-url="images[0]"></header-image>
        <div class="listings-container">
            <div class="heading">
                <h1>{{ title }}</h1>
                <p>{{ address }}</p>
                <hr>
                <div class="about">
                    <h3>About this listing</h3>
                    <expandable-text>{{ about }}</expandable-text>
                </div>
                <div class="lists">
                    <feature-list title="Amenities" :items="amenities">
                        <template slot-scope="amenity">
                            <i class="fa fa-lg" :class="amenity.icon"></i>
                            <span>{{ amenity.title }}</span>
                        </template>
                    </feature-list>
                    <feature-list title="Prices" :items="prices">
                        <template slot-scope="price">
                            {{ price.title }}: <strong>{{ price.value }}</strong>
                        </template>
                    </feature-list>
                </div>
            </div>
        </div>
        <modal-window ref="imagemodal">
            <image-carousel :images="images"></image-carousel>
        </modal-window>
    </div>
</template>

<script>
    import {populateAmenitiesAndPrices} from '../js/helpers';
    import routeMixin from '../js/route-mixin';

    import ExpandableText from './ExpandableText';
    import ImageCarousel from './ImageCarousel';
    import ModalWindow from './ModalWindow';
    import HeaderImage from './HeaderImage';
    import FeatureList from './FeatureList';

    export default {
        name: "ListingPage",
        mixins: [routeMixin],
        data() {
            return {
                title: null,
                address: null,
                about: null,
                amenities: [],
                prices: [],
                images: []
            }
        },
        methods: {
            assignData({listing}) {
                Object.assign(this.$data, populateAmenitiesAndPrices(listing))
            },
            openModal() {
                this.$refs.imagemodal.modalOpen = true;
            }
        },
        components: {
            ExpandableText,
            ImageCarousel,
            ModalWindow,
            HeaderImage,
            FeatureList
        }
    }
</script>

<style>
    .about {
        margin-top: 2em;
    }

    .about h3 {
        font-size: 22px;
    }
</style>