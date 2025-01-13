@extends('layouts.user_type.auth')
@section('content')
    <div class="container">
        <h3 class="text-center">Bookings</h3>
        <div class="row ">
            <div class="col-md-3">
                <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Room
                    Types</a>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <!-- DataTable Integration -->
                <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User Name</th>
                            <th>Room Type</th>
                            <th>Qty</th>
                            <th>Adult</th>
                            <th>Child</th>
                            <th>Action</th>>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($bookings as $booking)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $booking->customer->name }}</td>
                                <td>{{ $booking->roomType->name }}</td>
                                <td>{{ $booking->qty }}</td>
                                <td>{{ $booking->adult }}</td>
                                <td>{{ $booking->child }}</td>
                                <td>
                                    <!-- View Details Button -->
                                    <a href="{{ route('bookings.show', $booking) }}"
                                        class="btn btn-outline-info mr-2 rounded-pill">
                                        <i class="fa-solid fa-eye"></i> View
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="#"
                                        class="btn btn-outline-success mr-2 rounded-pill">
                                        Confirm
                                    </a>

                                    <!-- Delete Button (Opens the Modal) -->
                                    <button type="button" class="btn btn-outline-danger rounded-pill"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $booking->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="deleteModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $booking->id }}">Confirm
                                                Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this booking
                                            <strong>{{ $booking->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
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
                                <td colspan="8">
                                    <span class="text-danger">*No Booking data available. Empty List.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
