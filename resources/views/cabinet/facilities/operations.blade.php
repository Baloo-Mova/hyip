@extends('user')

@section('content')
    @include('alerts')

    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">@lang("messages.history_operations")</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>@lang("messages.type")</th>
                    <th>@lang("messages.sum")</th>
                    <th>@lang("messages.status")</th>
                    <th>@lang("messages.comment")</th>
                    <th>@lang("messages.date")</th>
                </tr>
                </thead>
                <tbody>
                @forelse($operations as $operation)
                    <tr>
                        <td>
                            {{ $operation->getType->name }}
                        </td>
                        <td>
                            {{ $operation->value }}₽
                        </td>
                        <td>
                            {{ ($operation->status == 0) ? "Новая" : (($operation->status == 1) ? "Выполнено" : "Отказ") }}
                        </td>
                        <td>
                            {{ $operation->comment }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse($operation->time)->format('d.m.Y H:i:s') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            <p>@lang("messages.no_items")</p>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt20 text-center">
                {{ $operations->links() }}
            </div>
        </div>
    </div>

@endsection