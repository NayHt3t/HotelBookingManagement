@extends('layouts.user_type.auth')
@section('content')
<div class="container">
    <h3 class="text-center">Booking Stay Info</h3>

    <!-- <div class="row ">
        <div class="col-md-3">
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Room
                Types</a>
        </div>
    </div> -->

    <form id="stayForm" action="{{ route('stayinfo.store') }}" method="POST">
    @csrf
    <input type="hidden" name="days" value="{{$days}}">
    <input type="hidden" name="booking_id" value="{{$booking->id}}">

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label>Guest</label>
                <select name="guest_id" class="form-control" required>
                    <option value="">Please Select Guest</option>
                    @foreach ($guests as $guest)
                    <option value="{{$guest->id}}">{{$guest->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label>Room Number</label>
                <select name="room_id" class="form-control" required>
                    <option value="">Please Select Room</option>
                    @foreach ($rooms as $room)
                    <option value="{{$room->id}}">{{$room->room_number}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mt-2">
                <!-- Trigger modal with the Add button -->
                <button type="button" class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#confirmModal">
                    Add
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to add this stay information?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Submit the form when the "Confirm" button is clicked -->
                <button type="button" class="btn btn-primary" onclick="document.getElementById('stayForm').submit();">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>



    <div class="row mt-1">
        <div class="col-md-12">
            <!-- DataTable Integration -->
            <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Guest Name</th>
                        <th>Room Number</th>
                        <th>Day</th>
                        <th>Start Date</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @forelse($stayInfos as $stayInfo)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $stayInfo->guest->name }}</td>
                        <td>{{ $stayInfo->room->room_number}}</td>
                        <td>{{ $stayInfo->days}}</td>
                        <td>{{ $stayInfo->start_date}}</td>

                        <td>
                            <!-- Cancel Button (Opens the Modal) -->
                            <button type="button" class="btn btn-outline-info rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#checkModal{{ 1 }}">
                                Check OUT
                            </button>

                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="checkModal{{ 1 }}" tabindex="-1"
                        aria-labelledby="checkModalLabel{{ 1 }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="checkModalLabel{{ 1 }}">
                                        Check Guest Info</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">



                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="8">
                            <span class="text-danger">*No Guest data available. Empty List.</span>
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