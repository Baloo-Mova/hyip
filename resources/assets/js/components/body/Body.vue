<template>
    <div class="chat__body">
        <div class="chat__dialog">
            <chat_messages v-for="message in messages" :message="message"></chat_messages>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                messages: []
            }
        },
        methods:{
            getMessages(){
                axios.post("/cabinet/chat/get-messages", {
                    my_id: 20,
                    you_id: 21
                })
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
            }
        },
        mounted() {
            setInterval(this.getMessages, 1000);
        }
    }
</script>

<style>
    .chat__body{
        padding: 0px 10px;
        text-align: left;
        overflow-y: auto;
        height: 70%;
    }
</style>
