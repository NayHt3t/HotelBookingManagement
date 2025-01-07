@extends('layouts.user_type.auth')
@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Room Prices</h3>
            <div class="col-md-3">
                <a href="{{ route('room-prices.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Room Price</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="row">
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
                            <td>{{ Str::ucfirst($room_price->priceType->name)}}</td>
                            <td>{{ $room_price->price}}</td>
                            <td>
                                <a href="{{ route('room-prices.edit', $room_price) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <button class="btn btn-outline-danger rounded-pill"
                                 data-bs-toggle="modal" data-bs-target="#deleteRoomPrice{{$room_price->id}}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                </form>
                            </td>
                        </tr>
                         <!--Delete Price Type Modal -->
                         <div class="modal fade" id="deleteRoomPrice{{$room_price->id}}" tabindex="-1" aria-labelledby="deleteRoomPriceLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteRoomPriceLabel{{ $room_price->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete the Room Price <strong>{{ ($room_price->price) }}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('room-prices.destroy', $room_price->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
