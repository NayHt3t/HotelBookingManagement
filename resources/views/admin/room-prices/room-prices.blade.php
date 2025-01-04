@extends('layouts.user_type.auth')
@section('content')
<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="text-center">
                    @if($message = Session::get('success'))
                    <span class="text-success">{{ $message }}</span>
                    @elseif ($message = Session::get('fail'))
                    <span class="text-danger">{{ $message }}</span>
                    @endif
                </div>
                <a href="{{ route('room-prices.create') }}" class="btn btn-primarybtn btn-primary btn-md active px-3 text-white">Add New Room Price</a>
                <table id="user_table" class="table table-hover table-bordered">
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
<!-- Add DataTables Scripts -->

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#user_table').DataTable(); // Initialize DataTable
    });
</script>
@endsection
