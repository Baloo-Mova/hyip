<template>
    <div class="chat__messages">

        <div v-if="message.from_user != my_id">
            <div class="from__message" id="bottom">
                <p>
                    {{ message.message}}
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="from__message_info">
                <p>
                    {{ user_id }} - {{ message.created_at }}
                </p>
            </div>
            <div class="clearfix"></div>
        </div>

        <div v-else>
            <div class="to__message" id="bottom">
                <p>
                    {{ message.message}}
                </p>
            </div>
            <div class="clearfix"></div>
            <div class="to__message_info">
                <p>
                    {{ you }} - {{ message.created_at}}
                </p>
            </div>
            <div class="clearfix"></div>
        </div>



        
    </div>
</template>

<script>
    export default {
        data(){
            return{
                my_id: window.my_id,
                user_id: window.user_name,
                you: window.you
            }
        },
        props: ['message']
    }
</script>

<style>
    .from__message{
        float: left;
        text-align: left;
        background-color: #A3E6A4;
        padding: 15px;
        margin: 20px;
        margin-left: 0;
        margin-bottom: 5px;
    }
    .from__message_info{
        text-align: left;
        float: left;
    }
    .from__message_info p,
    .to__message_info p{
        margin-bottom: 0;
        font-size: 12px;
        color: #222;
    }
    .to__message{
        float: right;
        padding: 15px;
        margin: 20px;
        margin-right: 0;
        margin-bottom: 5px;
        background-color: #F1F1F4;
        text-align: right;
    }
    .to__message p,
    .from__message p{
        margin-bottom: 0;
    }
    .to__message_info{
        text-align: right;
        float: right;
    }
    @media screen and (max-width: 760px){
        .chat__messages{
            padding-bottom: 10px;
        }
    }
</style>
