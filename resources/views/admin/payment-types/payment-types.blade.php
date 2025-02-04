@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <h3 class="text-center">Payment Methods</h3>
            
            <div class="col-md-3">
                <button class="btn btn-primary btn-md active px-3 text-white" data-bs-toggle="modal"
                    data-bs-target="#addPaymentTypeModal">Add New Payment Method</button>

                <!-- Add Category Modal -->
                <div class="modal fade" id="addPaymentTypeModal" tabindex="-1" aria-labelledby="addPaymentTypeModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="">Add Payment Method</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="p-3 d-flex justify-content-center">
                                <form action="{{route('payment-types.store')}}" method="post" class="w-90">
                                    @csrf
                                    <input type="text" name="method" id="" class="form-control" value="{{ old('method') }}" placeholder="Enter Payment Method">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary btn-md active px-3 text-white">Submit</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="data_table" class="table table-hover table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Method</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @forelse($paymentTypes as $paymentType)
                        <tr>
                            <td>{{++ $i }}</td>
                            <td>{{ $paymentType->method }}</td>
                            <td>

                                <a class="btn btn-outline-success mr-2 rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#editPaymentTypeModal"> <i class="fa-solid fa-pen-to-square"></i> </a>

                                <!-- Delete Button (Opens the Modal) -->
                                <button type="button" class="btn btn-outline-danger rounded-pill"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $paymentType->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Edit Category Modal -->
                        <div class="modal fade" id="editPaymentTypeModal" tabindex="-1" aria-labelledby="editPaymentTypeModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="">Edit Method</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="p-3  justify-content-center">
                                        <form action="{{route('payment-types.update',$paymentType->id)}}" method="post" class="w-90">
                                            @method("put")
                                            @csrf

                                            <input type="text" name="method" id="" class="form-control" value="{{$paymentType->method}}">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-md active px-3 text-white">Update</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $paymentType->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $paymentType->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $paymentType->id }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete these Payment Method ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('payment-types.destroy', $paymentType->id) }}" method="POST">
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

                            <td colspan="4">
                                <span class="text-danger">*Not available Payment Method data. Empty List.</span>
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