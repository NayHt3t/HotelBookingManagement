@extends('layouts.auth-master')
@section('content')
<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3">
                <a href="{{ route('room-types.create') }}" class="btn btn-primary">Add New Room Type</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="mt-2 mb-3">
                        @if($message = Session::get('success'))
                        <span class="text-success">{{ $message }}</span>
                        @endif
                    </div>
                </div>

                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Facilities</th>
                            <th>Num Rooms</th>
                            <th>Num People</th>
                            <th>Extra Bed</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($room_types as $roomtype)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $roomtype->category->name ?? 'No Category' }}</td>
                            <td>{{ $roomtype->name }}</td>
                            <td>{{ $roomtype->facilities }}</td>
                            <td>{{ $roomtype->num_rooms }}</td>
                            <td>{{ $roomtype->num_people }}</td>
                            <td>{{ $roomtype->extrabed_status ? 'Available' : 'Not Available' }}</td>
                            <td>{{ ucfirst($roomtype->status) }}</td>
                            <td>
                                <a href="{{ route('room-types.edit', $roomtype) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('room-types.destroy', $roomtype->id) }}" class="d-inline" method="post">
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
