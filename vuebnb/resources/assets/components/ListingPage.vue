<template>
    <div>
        <header-image @header-clicked="openModal" :image-url="images[0]"></header-image>
        <div class="container">
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
                    <feature-list title="Prices" :item="prices">
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

    import ExpandableText from './ExpandableText';
    import ImageCarousel from './ImageCarousel';
    import ModalWindow from './ModalWindow';
    import HeaderImage from './HeaderImage';
    import FeatureList from './FeatureList';

    let model = JSON.parse(window.vuebnb_listing_model);
    model = populateAmenitiesAndPrices(model);

    export default {
        name: "ListingPage",
        data() {
            return Object.assign(model, {})
        },
        methods: {
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