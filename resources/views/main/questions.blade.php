@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1>Вопрос-ответ</h1>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @forelse($faq as $item)
                    <div class="news__item faq__item">
                        <h4>{{ $item->question }}</h4>
                        <p>{{ $item->answer }}</p>
                    </div>
                @empty

                @endforelse
            </div>
            <div class="col-xs-12 text-center">
                {{ $faq->links() }}
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

