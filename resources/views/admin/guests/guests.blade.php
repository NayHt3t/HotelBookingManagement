@extends('layouts.user_type.auth')
@section('content')
<div class="container">
    <h3 class="text-center">Guset List</h3>
  

    <div class="row mt-1">
        <div class="col-md-12">
            <!-- DataTable Integration -->
            <table id="user_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>NRC or Passpost</th>
                        <th>email</th>
                        <th>phone</th>
                        <th>City</th>
                        <th>Action</th>>

                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @forelse($guests as $guest)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $guest->name }}</td>
                        <td>{{ $guest->nrc_or_passport}}</td>
                        <td>{{ $guest->email }}</td>
                        <td>{{ $guest->phone }}</td>
                        <td>{{ $guest->city }}</td>
                        <td>
                            <!-- Cancel Button (Opens the Modal) -->
                            <button type="button" class="btn btn-outline-info rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#checkModal{{ $guest->id }}">
                                <i class="fa-solid fa-eye"></i> View
                            </button>

                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="checkModal{{ $guest->id }}" tabindex="-1"
                        aria-labelledby="checkModalLabel{{ $guest->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="checkModalLabel{{ $guest->id }}">
                                        Check Guest Info</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    @php
                                    $createdAt = \Carbon\Carbon::parse($guest->booking->created_at);
                                    $date = $createdAt->format('Y-m-d'); // Format for the date
                                    $time = $createdAt->format('h:i A'); // Format for time with AM/PM
                                    @endphp

                                    <div class="row justify-content-center">
                                        <!-- First column -->
                                        <div class="col-md-6">
                                        <p>  Date: <strong>{{ $date }}</strong> </p>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Guest Name : <strong>{{$guest->name}}</strong></label>

                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Email : <strong>{{$guest->email}}</strong></label>

                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Address : <strong>{{$guest->address}}</strong></label>
                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">NRC or Passpost : <strong>{{$guest->nrc_or_passport}}</strong></label>
                                            </div>

                                        </div>
                                        <!-- Second column -->
                                        <div class="col-md-6">

                                        <p class="ms-7">  Time: <strong>{{ $time }}</strong> </p>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Booking By : <strong>{{$guest->booking->customer->name}}</strong> </label>

                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Phone : <strong>{{$guest->phone}}</strong></label>

                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">City : <strong>{{$guest->city}}</strong></label>
                                            </div>

                                            <div class="mt-2">
                                                <label for="" class="form-control">Country: <strong>{{$guest->country}}</strong></label>
                                            </div>

                                        </div>
                                    </div>

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