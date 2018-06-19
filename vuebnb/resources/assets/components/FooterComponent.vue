<template>
    <footer id="footer">
        <div class="hr"></div>
        <div :class="containerClass">
            <p>
                <img class="icon" src="/images/logo_grey.png" alt="Footer Icon">
                <span><strong>Vuebnb</strong>. A full-stack Vue.js and Laravel demo app.</span>
            </p>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "FooterComponent",
        computed: {
            containerClass() {
                return `${this.$route.name}-container`;
            }
        }
    }
</script>

<style>
    #footer {
        margin-bottom: 3em;
    }

    #footer .icon {
        height: 23px;
        display: inline-block;
        margin-bottom: -6px;
    }

    .hr {
        border-bottom: 1px solid #dbdbdb;
    }

    #footer p {
        font-size: 15px;
        color: #767676 !important;
        display: flex;
    }

    #footer img {
        padding-right: 6px;
    }
</style>