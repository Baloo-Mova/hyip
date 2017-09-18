<template>
    <div class="chat__messages">
        <div class="from__message">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi dignissimos harum, iusto laudantium nisi obcaecati possimus quas recusandae rerum sunt. Consequuntur corporis cum facilis incidunt neque possimus quas rerum sunt.
            </p>
        </div>
        <div class="from__message_info">
            <p>
                user - 08.09.17 12:44
            </p>
        </div>
        <div class="clearfix"></div>

        <div class="to__message">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad asperiores deleniti dolor dolore, dolores enim est facilis harum hic magnam maiores minima minus necessitatibus obcaecati odio quam quasi quod repellat.
            </p>
        </div>
        <div class="to__message_info">
            <p>
                Вы - 08.09.17 12:44
            </p>
        </div>
        <div class="clearfix"></div>
        
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
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
    }
    .to__message_info{
        text-align: right;
        float: right;
    }
</style>
