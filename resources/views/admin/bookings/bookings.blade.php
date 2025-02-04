@extends('layouts.user_type.auth')
@section('content')
<div class="container">
    <h3 class="text-center">Bookings</h3>
    <!-- <div class="row ">
        <div class="col-md-3">
            <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-md active px-3 text-white">Add New Room
                Types</a>
        </div>
    </div> -->

    <div class="row mt-1">
        <div class="col-md-12">
            <!-- DataTable Integration -->
            <table id="data_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Name</th>
                        <th>Room Type</th>
                        <th>Qty</th>
                        <th>Adult</th>
                        <th>Child</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                        <th>Action</th>

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
                        <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d-m-Y') }}</td>
                        <td>
                            @if($booking->status === config('booking.status.checkout'))
                            <span class="text-secondary">Checkout</span>
                            @elseif($booking->status === config('booking.status.pending'))
                            <span class="text-primary">Pending</span>
                            @elseif($booking->status === config('booking.status.staying'))
                            <span class="text-success">Staying</span>
                            @elseif($booking->status === config('booking.status.cancel'))
                            <span class="text-danger">Cancel</span>
                            @else
                            <span class="text-muted">Unknown</span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('bookings.check', $booking->id) }}"
                                class="btn btn-outline-info mr-2 rounded-pill">
                                <i class="fa-solid fa-eye"></i> Check
                            </a>

                            @if($booking->status === config('booking.status.pending'))

                            <a
                                class="btn btn-outline-success mr-2 rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#checkInModal{{$booking->id}}">
                                </i> Check IN
                            </a>



                            <!-- Booking Check_IN  Confirmation Modal -->
                            <div class="modal fade" id="checkInModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="checkInModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="checkInModalLabel{{ $booking->id }}">
                                                Confrim Check In</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure this booking is Check_IN ?
                                        </div>
                                        <div class="modal-footer">


                                            <form action="{{ route('bookings.check_in', $booking->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                                                <button type="submit" class="btn btn-primary">Confirm</button>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>

                            @endif

                            @if($booking->status === config('booking.status.staying'))


                            <a
                                class="btn btn-outline-danger mr-2 rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#checkOutModal{{$booking->id}}">
                                Check Out
                            </a>

                            <!-- Booking Check_Out Confirmation Modal -->
                            <div class="modal fade" id="checkOutModal{{$booking->id}}" tabindex="-1"
                                aria-labelledby="checkOutModalLabel{{$booking->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="checkOutModalLabel{{$booking->id}}">
                                                Confrim Check Out</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body text-danger">
                                            <h5>Are you sure this booking is Check_Out ?</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('bookings.check_out', $booking->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Confirm</button>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif






                            <a href=""
                                class="btn btn-outline-warning mr-2 rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#payFormModal{{ $booking->id }}">
                                </i> Payment
                            </a>

                            <!-- Booking Payment Form Modal -->
                            <div class="modal fade" id="payFormModal{{ $booking->id }}" tabindex="-1"
                                aria-labelledby="payFormModalLabel{{ $booking->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="payFormModalLabel{{ $booking->id }}">
                                                Payment for booking ID : {{$booking->id}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form action="{{ route('payments.store') }}" method="POST" style="display: inline;">
                                                @csrf

                                                <div class="row justify-content-center">
                                                    <div class="col-md-10">
                                                        <div class="form-group mb-3">
                                                            <label for="payment_type" class="form-label">Payment Method</label>
                                                            <select name="payment_type_id" id="payment_type" class="form-control">
                                                                <option value="">Select Method</option>
                                                                @foreach ($paymentTypes as $paymentType)
                                                                <option value="{{ $paymentType->id }}">{{ $paymentType->method}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group mb-3">
                                                            <label for="payment_type" class="form-label">Amount</label>
                                                            <input type="number" name="amount" class="form-control">
                                                        </div>
                                                        <!-- Hidden booking_id input -->
                                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">

                                                        <div class="d-flex justify-content-center">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                        <div class="modal-footer">



                                        </div>

                                    </div>
                                </div>
                            </div>

                            @if($booking->status == config('booking.status.pending') )
                            <!-- Cancel Button (Opens the Modal) -->
                            <button type="button" class="btn btn-outline-danger rounded-pill"
                                data-bs-toggle="modal" data-bs-target="#cancelModal{{ $booking->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="cancelModal{{ $booking->id }}" tabindex="-1"
                        aria-labelledby="cancelModalLabel{{ $booking->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cancelModalLabel{{ $booking->id }}">
                                        Confrim Cancel</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure this booking is Canceled ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

                                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Confirm</button>
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

@endsection