@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Confirm user</h1>
    </div>
    <div class="row">
        <div class="col-xs-12 col-lg-6">
            <div class="box">
                <div class="box-body">
                    <label for="">Passport data:</label>
                    <ul class="no-dots">
                        <?php $pd = json_decode($data->passport_data); ?>
                        <li>{{ $pd->name }}</li>
                        <li>{{ $pd->surname }}</li>
                        <li>{{ $pd->middleName }}</li>
                        <li>{{ $pd->series." ".$pd->number }}</li>
                        <li>{{ $pd->issuedby }}</li>
                        <li>{{ \Carbon\Carbon::parse($pd->dateofissue)->format("d.m.Y") }}</li>
                    </ul>
                    <hr>
                    <label for="">Passport scans:</label>
                    <br>
                    @foreach($scans as $scan)
                        <a href="{{ route('get.image', ['type' => 'scans', 'name' => $scan->photo]) }}" data-fancybox="group">
                            <div class="profile_scan_img__wrap"
                                 style="background-image: url({{ route('get.image', ['type' => 'scans', 'name' => $scan->preview]) }})">
                            </div>
                        </a>
                    @endforeach
                    <hr>
                    <form action="" method="post" class="inline-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                        <input type="hidden" name="is_confirm" value="1">
                        <button type="submit" class="btn btn-success btn-flat">Confirm</button>
                    </form>
                    <form action="" method="post" class="inline-form">
                        {{ csrf_field() }}
                        <input type="hidden" name="user_id" value="{{ $data->user_id }}">
                        <input type="hidden" name="is_confirm" value="0">
                        <button type="submit" class="btn btn-warning btn-flat">Refuse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $(document).ready(function () {

            $("[data-fancybox]").fancybox({});

        });
    </script>
@stop