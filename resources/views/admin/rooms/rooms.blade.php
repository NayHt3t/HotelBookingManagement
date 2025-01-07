@extends('layouts.user_type.auth')
@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">Rooms</h3>
                    <!-- Button to add a new room -->
                    <a href="{{ route('rooms.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Room</a>

                    <!-- Displaying Rooms -->
                    <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Room Type</th>
                                <th>Room Number</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rooms as $room)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $room->roomType->name }}</td>
                                    <td>{{ $room->room_number }}</td>
                                    <td>{{ $room->location }}</td>
                                    <td>{{ $room->status == 1 ? 'Available' : ($room->roomType->status == 2 ? 'Booking' : 'Unavailable') }}
                                    </td>

                                    <td>


                                <!-- Edit Button -->
                                <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>



                                        <button type="button" class="btn btn-outline-danger rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal{{ $room->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $room->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $room->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $room->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete room <strong>{{ $room->room_number }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <span class="text-danger">*No Room data available. Empty List.</span>
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
