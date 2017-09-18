<template>
    <div class="chat__body">
        <chat_messages></chat_messages>
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
    .chat__body{
        padding: 0px 10px;
        text-align: left;
        overflow-y: auto;
        height: 70%;
    }
</style>
