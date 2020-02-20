<template>
    <div id="exampleModalLive" class="modal fade show" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLiveLabel" style="display: block; padding-right: 15px; background-color:#314a69b0">
        <div class="modal-dialog" role="document">
            
            <div class="model-content">
                <div class="text-center">
                    <img src="/assets/images/dark_tick.gif" alt="" style="border-radius: 15%;height: 227px;" />
                    
                </div>
                <div style="color:white" @click="triggerMe()">
                    {{success_text}}
                </div>
                <div class="btn btn-success" @click="triggerMe()" >Great</div>
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
            triggerMe()
            {
                console.log('what ');
            },
            disMissError() {
                console.log('dismissing sub success');
                this.$emit('dis-miss-subsuccess-modal');
            }
        },
        props: ["success_text"]
    }

</script>
