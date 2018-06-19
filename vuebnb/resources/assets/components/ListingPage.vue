<template>
    <div>
        <header-image
                @header-clicked="openModal"
                v-if="listing.images[0]"
                :image-url="listing.images[0]"
                :id="listing.id"></header-image>
        <div class="listings-container">
            <div class="heading">
                <h1>{{ listing.title }}</h1>
                <p>{{ listing.address }}</p>
                <hr>
                <div class="about">
                    <h3>About this listing</h3>
                    <expandable-text>{{ listing.about }}</expandable-text>
                </div>
                <div class="lists">
                    <feature-list title="Amenities" :items="listing.amenities">
                        <template slot-scope="amenity">
                            <i class="fa fa-lg" :class="amenity.icon"></i>
                            <span>{{ amenity.title }}</span>
                        </template>
                    </feature-list>
                    <feature-list title="Prices" :items="listing.prices">
                        <template slot-scope="price">
                            {{ price.title }}: <strong>{{ price.value }}</strong>
                        </template>
                    </feature-list>
                </div>
            </div>
        </div>
        <modal-window ref="imagemodal">
            <image-carousel :images="listing.images"></image-carousel>
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

    export default {
        name: "ListingPage",
        computed: {
            listing() {
                return populateAmenitiesAndPrices(this.$store.getters.getListing(parseInt(this.$route.params.listing)));
            }
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