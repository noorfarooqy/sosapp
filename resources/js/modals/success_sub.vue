<template>
    <div id="exampleModalLive" class="modal fade show" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLiveLabel" style="display: block; padding-right: 15px; background-color:#314a69b0">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background-color: unset; border: unset;">
               
                <div class="modal-body">
                    <div class="text-center">
                    <img src="/assets/images/dark_tick.gif" alt="" style="border-radius: 15%;height: 227px;" />
                    <div style="color:white" @click="triggerMe()">
                        {{success_text}}
                    </div>
                    <div class="btn btn-success" @click="disMissError()" >Great</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: 'sub_success',
                version: 1,
            }

        },
        methods: {
            disMissError() {
                console.log('dismissing sub success');
                this.$emit('dis-miss-subsuccess-modal');
            }
        },
        props: ["success_text"]
    }

</script>
