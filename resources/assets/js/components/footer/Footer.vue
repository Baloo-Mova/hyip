<template>
    <div class="chat__footer">
        <div class="col-xs-12 col-sm-10 col-md-10 left_block">
            <textarea name="" class="form-control btn-flat" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2 right_block">
            <button class="btn btn-flat btn-main-carousel">Отправить</button>
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
        .left_block{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .right_block{
            padding-left: 0px !important;
            padding-right: 0px !important;
            margin-top: 10px;
        }
        .right_block button{
            width: 100%;
        }
    }
    @media screen and (min-width: 760px){
        .left_block{
            padding-left: 0px !important;
        }
        .right_block{
            padding-left: 0px !important;
            padding-right: 0px !important;
            text-align: center;
        }
        .right_block button{
            margin-top: 30px;
        }
    }
</style>
