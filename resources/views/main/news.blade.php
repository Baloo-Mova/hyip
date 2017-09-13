@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Новости</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12">
                @forelse($data['news'] as $news)
                    <div class="news__item">
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="news_title">
                                    <img src="{{ asset('media/uploads/blog').'/'.$news['preview'] }}" alt="">
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-9">
                                <div class="news__description">
                                    <h4>{{ $news['title'] }}</h4>
                                    <p>
                                        {!!  $news['content'] !!}
                                        <a href="{{ route('news.show', ['id' => $news['id']]) }}" class="red-text">подробнее</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                @endforelse
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

