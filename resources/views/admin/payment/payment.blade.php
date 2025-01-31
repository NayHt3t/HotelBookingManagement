@extends('layouts.user_type.auth')
@section('content')
<div class="container">
    <h3 class="text-center">Payment History</h3>

    <div class="row mt-1">
        <div class="col-md-12">
            <!-- DataTable Integration -->
            <table id="data_table" class="table table-hover table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Booking ID</th>
                        <th>Payment Method</th>
                        <th>Amount (MMK)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 0; @endphp
                    @forelse($payments as $payment)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>BID:{{ $payment->booking->id }}</td>
                        <td>{{ $payment->paymentType->method}}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>
                            @if($payment->status === config('payment.status.pending'))
                            <span class="text-primary">Pending</span>
                            @elseif($payment->status === config('payment.status.complete'))
                            <span class="text-success">Complete</span>
                            @endif
                        </td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5">
                            <span class="text-danger">*No Payment data available. Empty List.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection