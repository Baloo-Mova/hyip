<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="WhiteCoin">
    <link rel="icon" sizes="192x192" href="{{ asset('img/logo_md.png') }}">
    <meta content="{{ asset('img/logo_md.png') }}" property="og:image" />
    <meta content="{{env('APP_NAME')}}" property="og:site_name" />
    <meta content="object" property="og:type" />
    <meta content="WhiteCoin" property="og:title" />
    <meta content="Описание" property="og:description" />
    <title>{{env('APP_NAME')}}</title>
    @include('partial.head')
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
</head>
<body>
<div id="preloader"></div>

@if (Session::has('messages'))
    <div class="modal fade in close_feedback_modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: block;">
        <div class="modal-dialog btn-flat" role="document">
            <div class="modal-content btn-flat">
                <div class="modal-header">
                    <button type="button" class="close close_feedback_modal_close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">@lang("messages.send_successful_message")</h4>
                </div>
                <div class="modal-body">
                    @foreach (Session::get('messages') as $message)
                        <p>{{ $message }}</p>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat close_feedback_modal_close" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endif

@include('partial.mainmenu')

@yield('content')


@include('partial.footer')

@include('partial.scripts')
@yield('js')
<script>
    $(document).ready(function () {
       $(".close_feedback_modal_close").on("click", function () {
          $(".close_feedback_modal").hide();
       });
    });
</script>
</body>
</html>
