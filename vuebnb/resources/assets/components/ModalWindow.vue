<template>
    <div id="modal" :class="{show: modalOpen}">
        <button class="modal-close" v-on:click="modalOpen = false">&times;</button>
        <div class="modal-content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ModalWindow",
        data() {
            return { modalOpen: false }
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
        },
    }
</script>

<style scoped>

    #modal {
        display: none;
        position: fixed;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        z-index: 2000;
    }

    #modal.show {
        display: block;
        background-color: rgba(0, 0, 0, 0.85);
    }

    .modal-content {
        height: 100%;
        max-width: 105vh;
        padding-top: 12vh;
        margin: 0 auto;
        position: relative;
    }

    body.modal-open {
        overflow: hidden;
        /*position: fixed;*/
    }

    .modal-close {
        position: absolute;
        right: 0;
        top: 0;
        padding: 0 28px 8px;
        font-size: 4em;
        width: auto;
        height: auto;
        background: transparent;
        border: 0;
        outline: none;
        color: white;
        z-index: 1000;
        font-weight: 100;
        line-height: 1;
    }
</style>