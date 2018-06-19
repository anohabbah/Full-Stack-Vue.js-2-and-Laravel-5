<template>
    <div class="listing-save" @click.stop="toggleSaved">
        <button v-if="button">
            <i :class="classes"></i>
            {{ message }}
        </button>
        <i v-else :class="classes"></i>
    </div>
</template>

<script>
    export default {
        name: "ListingSave",
        props: ['id', 'button'],
        computed: {
            isListingSaved() {
                return this.$store.state.saved.includes(this.id);
            },
            classes() {
                return {
                    fa: true,
                    'fa-lg': true,
                    'fa-heart': this.isListingSaved,
                    'fa-heart-o': !this.isListingSaved
                };
            },
            message() {
                return this.isListingSaved ? 'Saved' : 'Save';
            }
        },
        methods: {
            toggleSaved() {
                this.$store.dispatch('toggleSaved', this.id);
            }
        }
    }
</script>

<style lang="scss">
    .listing-save {
        position: absolute;
        top: 20px;
        right: 20px;
        cursor: pointer;

        .fa-heart-o {
            color: #fff;
        }

        .fa-heart {
            color: #ff5a5f;
        }

        i {
            padding-right: 4px;
        }

        button .fa-heart-o {
            color: #808080;
        }
    }

</style>