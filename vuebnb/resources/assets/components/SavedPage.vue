<template>
    <div id="saved" class="home-container">
        <h2>Saved Listings</h2>

        <div v-if="listings.length" class="listing-summaries">
            <listing-summary v-for="listing in listings" :listing="listing" :key="listing.id"></listing-summary>
        </div>
        <div v-else>No saved listing.</div>
    </div>
</template>

<script>
    import ListingSummary from './ListingSummary';

    export default {
        name: "SavedPage",
        computed: {
            listings() {
                return this.$store.getters.listingSummaries;
            }
        },
        components: {ListingSummary}
    }
</script>

<style lang="scss">
    #saved {
        .listing-summaries {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            overflow: hidden;

            .listing-summary {
                padding-bottom: 30px;
            }
        }
    }

    .listing-summaries .listing-summary {
        margin-right: 15px;
    }
</style>
