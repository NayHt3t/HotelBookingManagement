@extends('layouts.user_type.auth') 
@section('content')


<div class="container">
    <h1 class="text-center"> Room Type</h1>
    <div class="row ">
        <div class="col-md-3">
            <a href="{{ route('room-types.create') }}" class="btn btn-primary">Add New Room Types</a>
        </div>
    </div>

    <div class="row mt-1">
        <div class="col-md-12">
           
                <div class="text-center">

                    @if($message = Session::get('success'))
                    <span class="text-success">{{ $message }}</span>
                    @endif
                    @if($message = Session::get('unsuccess'))
                    <span class="text-danger">{{ $message }}</span>
                    @endif
                </div>

            <!-- DataTable Integration -->
            <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Rooms</th>
                        <th>People</th>
                        <th>Extra Bed</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @forelse($roomTypes as $roomType)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $roomType->name }}</td>
                        <td>{{ $roomType->category->name }}</td> <!-- Assuming category relationship -->
                        <td>{{ $roomType->num_rooms }}</td>
                        <td>{{ $roomType->num_people }}</td>
                        <td>{{ $roomType->extrabed_status ? 'Yes' : 'No' }}</td>
                        <td>{{ $roomType->status == 1 ? 'Available' : ($roomType->status == 2 ? 'Booking' : 'Unavailable') }}</td>
                        <td>
                            <!-- View Details Button -->
                            <a href="{{ route('room-types.show', $roomType) }}" class="btn btn-outline-info mr-2 rounded-pill">
                                <i class="fa-solid fa-eye"></i> View
                            </a>

                            <!-- Edit Button -->
                            <a href="{{ route('room-types.edit', $roomType) }}" class="btn btn-outline-success mr-2 rounded-pill">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <!-- Delete Button (Opens the Modal) -->
                            <button type="button" class="btn btn-outline-danger rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $roomType->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteModal{{ $roomType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $roomType->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $roomType->id }}">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the Room Type <strong>{{ $roomType->name }}</strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('room-types.destroy', $roomType->id) }}" method="POST">
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
                            <span class="text-danger">*No Room Type data available. Empty List.</span>
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