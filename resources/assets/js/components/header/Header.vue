<template>
    <div class="chat__header">
        <h4>{{ title }} - {{ name }}</h4>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                name: window.user_name,
                title: window.main_title
            }
        }
    }
</script>

<style>
    .chat__header{
        background-color: #F2F2F2;
        border-bottom: 1px solid #f1f1f1;
        padding: 15px 10px;
        text-align: left;
        height: 50px;
    }
    .chat__header h4{
        margin: 0;
    }
</style>
