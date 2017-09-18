<template>
    <div class="chat__header">
        <h4>Чат с пользователем -</h4>
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
