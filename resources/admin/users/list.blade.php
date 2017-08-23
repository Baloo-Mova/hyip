@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <h1 class="sub-header">Users</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Referrals</th>
                    <th>Users</th>
                </tr>
            </thead>
            <tbody>
                @foreach($referrals as $key => $referral)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $referral }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="table table-striped">
            <thead>
                <tr>
                    @foreach($levels as $key => $level)
                        <th>{{ $key }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($levels as $level)
                        <td>{{ $level }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

@endsection