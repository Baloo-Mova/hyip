<template>
    <div class="chat__messages">

        <div v-if="message.from_user != my_id">
            <div class="from__message" id="bottom">
                <p>
                    {{ message.message}}
                </p>
            </div>
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
            <div class="to__message_info">
                <p>
                    Вы - {{ message.created_at}}
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
                user_id: window.user_name
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
        padding: 10px;
        margin: 20px;
        margin-left: 0;
        margin-bottom: 0;
        width: 96%;
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
        padding: 10px;
        margin: 20px;
        margin-right: 0;
        margin-bottom: 0;
        background-color: #F1F1F4;
        width: 96%;
    }
    .to__message_info{
        text-align: right;
        float: right;
    }
    @media screen and (max-width: 760px){
        .chat__messages{
            padding-bottom: 100px;
        }
    }
</style>
