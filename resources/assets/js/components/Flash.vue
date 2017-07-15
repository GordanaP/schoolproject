<template>

    <div class="alert alert-warning alert__flash" role="alert"
        v-show="isVisible"
    >
        <div class="flex align-center">
            <div class="alert__flash-type flex-1">
                <strong>Success!</strong>
            </div>
            <div class="alert__flash-message flex-3">
                {{ body }}
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['message'],

        data () {
            return {
                body: '',
                isVisible: false
            }
        },

        created() {
            if(this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', message => this.flash(message));
        },

        methods : {
            flash(message) {
                this.body = message;
                this.isVisible = true;

                this.hide();
            },

            hide() {
                setTimeout(()=> {
                    this.isVisible = false;
                }, 3000);
            }
        }
    }
</script>

<style>
    .alert__flash {
        position: fixed;
        bottom: 10px;
        right: 10px;
        padding: 0;
        font-size: 13px;
        margin-bottom: 0;
    }
    .alert__flash-type{ background: #031634; padding: 19px 0px 19px 10px; }
    .alert__flash-message{ background: #acd0d2; padding:10px}
</style>
