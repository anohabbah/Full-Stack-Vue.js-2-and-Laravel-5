<template>
    <div class="header">
        <div class="header-img" v-bind:style="headerImageStyle" v-on:click="$emit('header-clicked')">
            <button class="view-photos">View Photos</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "HeaderImage",
        props: ['image-url'],
        computed: {
            headerImageStyle() {
                return {
                    'background-image': `url(${this.imageUrl})`
                };
            }
        }
    }
</script>

<style>
    .header {
        height: 320px;
    }

    .header .header-img {
        background: #f5f5f5 no-repeat 50% 50%;
        background-size: cover;
        height: 100%;
        cursor: pointer;
        position: relative;
    }

    .header .header-img .view-photos {
        position: absolute;
        bottom: 20px;
        left: 20px;
    }

    .header .header-img button {
        font-size: 14px;
        padding: 7px 18px;
        color: #484848;
        line-height: 1.43;
        background: #ffffff;
        font-weight: bold;
        border-radius: 4px;
        border: 1px solid #c4c4c4;
    }
</style>