<template>
    <div class="chat__footer">
            <textarea name="" class="form-control btn-flat"
                      v-model="text"
                      @keyup.enter="sendMessage"></textarea>
            <button class="btn btn-flat btn-main-carousel send__button" v-on:click="sendMessage">
                <span class="hidden-sm hidden-md hidden-lg">Отправить</span>
                <i class="fa fa-paper-plane-o fa-2x hidden-xs" aria-hidden="true"></i>
            </button>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                text: ''
            }
        },
        methods:{
            sendMessage(){
                var txt = this.text;
                this.text = "";
                axios.post("/cabinet/chat/send", {
                    my_id: 20,
                    you_id: 21,
                    text: txt
                })
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        }
    }
</script>

<style>
    .chat__footer{
        background-color: #F2F2F2;
        border-top: 1px solid #f1f1f1;
        padding: 20px 10px;
        text-align: left;
        min-height: 150px;
        position: absolute;
        width: 100%;
        bottom: 0;
    }
    textarea.form-control {
        height: 110px;
        resize: none;
    }
    @media screen and (max-width: 760px){
        .send__button{
            width: 100%;
            margin-top: 10px;
        }
    }
    @media screen and (min-width: 760px){
        .send__button{
            position: absolute;
            right: 40px;
            top: 50px;
            border-radius: 50% !important;
            width: 45px;
            height: 45px;
            padding-top: 8px;
            padding-left: 6px;
        }
        textarea.form-control {
            padding-right: 72px;
        }
    }
</style>
