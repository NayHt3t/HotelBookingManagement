@extends('layouts.user_type.auth')

@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Rooms</h2>

                <!-- Button to add a new room -->
                <a href="{{ route('rooms.create') }}" class="btn btn-primary mb-3">Add New Room</a>

                <!-- Displaying Rooms -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room Type</th>
                            <th>Room Number</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $room->roomType->name }}</td>
                            <td>{{ $room->room_number }}</td>
                            <td>
                                <!-- Display the status -->
                                <span class="badge 
                                    @if($room->status == 'available') 
                                        badge-success 
                                    @elseif($room->status == 'unavailable') 
                                        badge-danger 
                                    @else 
                                        badge-secondary 
                                    @endif
                                ">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Delete Button -->
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
