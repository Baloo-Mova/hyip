@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ $content->title }}</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                {!! $content->content !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('html, body').hide();

            if (window.location.hash) {
                setTimeout(function() {
                    $('html, body').scrollTop(0).show();
                    $('html, body').animate({
                        scrollTop: $(window.location.hash).offset().top - 145
                    }, 1000)
                }, 0);
            }
            else {
                $('html, body').show();
            }

            $(".about_menu_a").on("click", function(){
                var anc = $(this).data("anchor");
                $('html, body').animate({
                    scrollTop: $("#"+anc).offset().top - 145
                }, 1000);
            });
        });
    </script>
@stop

