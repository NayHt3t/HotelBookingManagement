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
    <div>
        @if($rooms->count()>0)
        <form id="stayForm" action="{{ route('stayinfo.store') }}" method="POST">
            @csrf
            <input type="hidden" name="booking_id" value="{{$booking->id}}">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Guest</label>
                        <select name="guest_id" class="form-control" required>
                            @if($guests->count() >0)
                            <option value="">Please Select Guest</option>
                            @else
                            <option value="">All Guests are Assigned.</span></option>
                            @endif
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
                        <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            Assign
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif

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

    <div>
        <div class="row">

            <div class="col-md-3">
                <small>Total Amount : <strong>{{$totalAmount}}</strong> MMK</small>
            </div>

            <div class="col-md-3">
                <small>Current Amount : <span class="text-dark"><strong>{{$currentAmount}}</strong> MMK</span> </small>
            </div>

            <div class="col-md-3">
                @if($currentAmount >= $totalAmount)
                <small><strong class="text-success">Payment Complete</strong></small>
                @else
                <small>Credit Amount: <strong class="text-danger">{{ $totalAmount - $currentAmount }}</strong> MMK</small>
                @endif
            </div>


            @if($booking->status !=config('booking.status.checkout'))
            <div class="col-md-3 ">
                <button class="btn btn-primary ms-5 " data-bs-toggle="modal" data-bs-target="#addGuestModal">Add Guest</button>
            </div>
            @endif

        </div>

        <!-- Add Guest Modal -->
        <div class="modal fade" id="addGuestModal" tabindex="-1"
            aria-labelledby="addGuestModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addGuestModalLabel">
                            Guest Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">

                        <form action="{{route('guests.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                            <div class="row justify-content-center">
                                <!-- First column -->
                                <div class="col-md-6">


                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="name" placeholder="Guest name" required>
                                    </div>

                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="email" placeholder="Email" required>
                                    </div>

                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="city" placeholder="City" required>
                                    </div>


                                </div>
                                <!-- Second column -->
                                <div class="col-md-6">


                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="nrc_or_passport" placeholder="NRC or Passport" required>
                                    </div>

                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="nrc_or_passport" placeholder="Phone" required>
                                    </div>

                                    <div class="mt-2">
                                        <input type="text" class="form-control" name="country" placeholder="Country" required>
                                    </div>

                                </div>
                                <div class="mt-2">
                                    <input type="text" class="form-control" name="address" placeholder="Address" required>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Sumbit</button>
                    </div>
                    </form>

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
                            <th>Check IN</th>
                            <th>Check Out</th>
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
                            <td>{{ \Carbon\Carbon::parse($stayInfo->check_in)->format('Y-m-d h:i A') }}</td>
                            <td>
                                @if($stayInfo->check_out)
                                {{ \Carbon\Carbon::parse($stayInfo->check_out)->format('Y-m-d h:i A') }}
                                @else
                                <P class="text-success">Current Staying</P>
                                @endif
                            </td>


                            <td>


                                @if($stayInfo->check_out)
                                <p class="text-danger">Check out</p>
                                @else
                                <!-- Cancel Button (Opens the Modal) -->
                                <button type="button" class="btn btn-outline-info rounded-pill"
                                    data-bs-toggle="modal" data-bs-target="#checkOutModal{{ $stayInfo->id }}">
                                    Check OUT
                                </button>
                                @endif

                            </td>
                        </tr>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="checkOutModal{{ $stayInfo->id }}" tabindex="-1"
                            aria-labelledby="checkOutModalLabel{{ $stayInfo->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="checkOutModalLabel{{$stayInfo->id}}">
                                            Confirm Check out</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <p>Are you sure Customer: <span class="text-primary">{{$stayInfo->guest->name}}</span> is Check out ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('stayinfo.check_out',$stayInfo->id)}}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                            <button type="submit" class="btn btn-primary">Confirm</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="8">
                                <span class="text-danger">*No Stay Info available. Empty List.</span>
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