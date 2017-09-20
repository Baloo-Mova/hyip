@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>@lang('messages.stocks')</h1>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                @forelse($data['stock'] as $stock)
                    <div class="news__item">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="news_title">
                                    <img src="{{ route('get.image', ['type' => 'blog', 'name' => $stock['preview']]) }}" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-9 left-text">
                                <div class="news__description">
                                    <h4>{{ $stock['title'] }}</h4>
                                    <p>
                                        {!!  $stock['content'] !!}
                                    </p>
                                </div>
                                <a href="{{ route('stock.show', ['uri' => $stock['uri']]) }}" class="red-text">@lang('messages.more')</a>
                            </div>
                        </div>

                    </div>
                @empty
                @endforelse
            </div>
            <div class="col-xs-12 text-center">
                {{ $data['stock']->links() }}
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(function () {

        });
    </script>
@stop

