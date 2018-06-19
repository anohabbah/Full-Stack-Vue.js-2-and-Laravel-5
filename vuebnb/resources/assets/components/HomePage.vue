<template>
    <div class="home-container">
        <listing-summary-group
                v-for="(group, country) in listing_groups"
                :country="country"
                :key="country"
                :listings="group"></listing-summary-group>
    </div>
</template>

<script>
    import {groupByCountry} from "../js/helpers";
    import ListingSummaryGroup from './ListingSummaryGroup';

    import routeMixin from '../js/route-mixin';

    export default {
        name: "HomePage",
        mixins: [routeMixin],
        data() {
            return {
                listing_groups: []
            }
        },
        components: {ListingSummaryGroup},
        methods: {
            assignData({listings}) {
                this.listing_groups = groupByCountry(listings);
            }
        }
    }
</script>
