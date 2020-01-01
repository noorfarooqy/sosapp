<template>
    <div id="exampleModalLive" class="modal fade show" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLiveLabel" style="display: block; padding-right: 15px; background-color:#314a69b0">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLiveLabel">Error!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="disMissError">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{error_text}}</p>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: 'error_modal',
                version: 1,
            }

        },
        methods: {
            disMissError()
            {
                this.$emit('dis-miss-error-modal');
            }
        },
        props:["error_text"]
    }

</script>
