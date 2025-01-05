@extends('layouts.auth-master')
@section('content')
<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{ route('room-prices.create') }}" class="btn btn-primary">Add New Room Price</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="mt-2 mb-3">
                        @if($message = Session::get('success'))
                        <span class="text-success">{{ $message }}</span>
                        @elseif ($message = Session::get('fail'))
                        <span class="text-danger">{{ $message }}</span>
                        @endif
                    </div>
                </div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Room Type</th>
                            <th>Price Type</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($room_prices as $room_price)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $room_price->roomType->name}}</td>
                            <td>{{ $room_price->priceType->name}}</td>
                            <td>{{ $room_price->price}}</td>
                            <td>
                                <a href="{{ route('room-prices.edit', $room_price) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('room-prices.destroy', $room_price->id) }}" class="d-inline" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-outline-danger ml-2 rounded-pill btn-delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">
                                <span class="text-danger">*No room types available. Empty list.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
