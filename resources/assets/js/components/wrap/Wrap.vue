<template>
    <div class="container h100">
        <div class="row h100">
            <div class="col-xs-12 h100">
                <div class="news__item chat__wrap_wrapper">
                    <chat_header></chat_header>
                    <chat_body></chat_body>
                    <chat_footer></chat_footer>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
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
    .chat__wrap_wrapper{
        height: 100%;
        padding: 0;
        position: relative;
        overflow: hidden;
    }
</style>
