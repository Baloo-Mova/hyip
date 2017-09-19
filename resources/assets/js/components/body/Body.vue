<template>
    <div class="chat__body" @scroll="onScroll">
        <div class="messages">
            <chat_messages v-for="message in messages" :message="message" ></chat_messages>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                messages: [],
                last_id: 0,
                count: 0,
                offset: 10,
                messages_count_now: 0
            }
        },
        methods:{
            getMessages(){
                axios.post("/cabinet/chat/get-messages", {
                    chat_id: window.chat_id,
                    last_id: this.last_id,
                    offset: this.offset,
                    user_id: window.my_id,
                    page: 1
                })
                .then((response) => {
                    if(this.count != response.data.count){
                        this.messages = response.data.messages.concat(this.messages);
                        this.messages_count_now += response.data.messages.length;
                        var container = document.querySelector(".chat__body");
                        container.scrollTop = 0;
                    }
                    this.last_id = response.data.last_id;
                    this.count = response.data.count;
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            getScrollMessages(){
                axios.post("/cabinet/chat/get-scroll-messages", {
                    chat_id: window.chat_id,
                    count: this.messages_count_now,
                    take: this.offset
                })
                .then((response) => {
                    this.messages = this.messages.concat(response.data);
                    this.messages_count_now += response.data.length;
                })
                .catch((error) => {
                    console.log(error);
                });
            },
            onScroll(event){
                var wrapper = event.target,
                    list = wrapper.firstElementChild,
                    scrollTop = wrapper.scrollTop,
                    wrapperHeight = wrapper.offsetHeight,
                    listHeight = list.offsetHeight,
                    diffHeight = listHeight - scrollTop - wrapperHeight;

                if(diffHeight == 0){
                    this.getScrollMessages();
                }
            }
        },
        mounted() {
            this.getMessages();
            setInterval(this.getMessages, 5000);
            this.$root.$on('message_sended', section => {
                this.getMessages();
            });
        }
    }
</script>

<style>
    .chat__body{
        padding: 0px 10px;
        text-align: left;
        overflow-y: scroll;
        height: 70%;
    }
</style>
