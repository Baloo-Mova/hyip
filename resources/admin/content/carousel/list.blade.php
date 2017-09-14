@extends('Admin::index')

@section('content')
    @include('Admin::alerts')

    <div>
        <a href='{{ route('admin.carousel.add') }}' class="btn-sm btn-primary pull-right">
            <i class="fa fa-plus-square" aria-hidden="true"></i>
            Add
        </a>
        <h1 class="sub-header">Carousel</h1>
    </div>

    @if (count($items))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Text</th>
                    <th>Background image</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr class="item-{{ $item->id }}">
                        <td>{{ $item->text }}</td>
                        <td><img src="{{ route('get.image', ['type' => 'carousel', 'name' => $item->background_file]) }}" alt="" style="width: 100px;"></td>
                        <td>
                            <a href='{{ route('admin.carousel.get', ['id' => $item->id]) }}'>
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            &nbsp;&nbsp;&nbsp;
                            <a href="{{ route('admin.carousel.delete', ['id' => $item->id]) }}" onclick="return confirm('Delete this slide?')" style="cursor: pointer;">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pull-right">
                {{ $items->render() }}
            </div>
        </div>
    @else
        <div>No items</div>
    @endif
@endsection