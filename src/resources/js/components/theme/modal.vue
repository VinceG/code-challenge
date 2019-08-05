<template>
    <div>
        <div
            :class="{'show d-block': visible}"
            class="modal fade"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div
                :class="{'modal-xl': isXl, 'modal-lg': isLarge}"
                class="modal-dialog modal-dialog-centered"
                role="document"
            >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-if="title" class="modal-title" v-text="title" />
                        <button v-if="dismissible" type="button" class="close" data-dismiss="modal" aria-label="Close" @click="onClose">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-md-8 py-4">
                        <slot />
                    </div>
                    <div class="modal-footer">
                        <slot name="footer" />
                    </div>
                </div>
            </div>
        </div>
        <div v-if="visible" class="modal-backdrop fade show" />
    </div>
</template>

<script>
export default {
    props: {
        visible: {
            type: Boolean,
            default: false
        },
        dismissible: {
            type: Boolean,
            default: true
        },
        isXl: {
            type: Boolean,
            default: false
        },
        isLarge: {
            type: Boolean,
            default: false
        },
        title: {
            type: String,
            default: ''
        }
    },
    watch: {
        visible: function() {
            if (this.visible) {
                document.querySelectorAll('body')[0].classList.add('modal-open');
            } else {
                document.querySelectorAll('body')[0].classList.remove('modal-open');
            }
        }
    },
    methods: {
        onClose() {
            this.$emit("close");
        }
    }
};
</script>
