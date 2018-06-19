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

    export default {
        name: "HomePage",
        computed: {
            listing_groups() {
                return groupByCountry(this.$store.state.listing_summaries);
            }
        },
        components: {ListingSummaryGroup}
    }
</script>
