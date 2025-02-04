@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                        <div>
                            <h5 class="text-center">All Customers</h5>
                        </div>
                </div>
                <div class="card-body px-0 pt-3 px-3 pb-2">
                    <div class="table-responsive p-0">
                        <table id="data_table" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Enable
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    @can('isAdminOrManager')
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @forelse($customers as $customer)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-sm font-weight-bold mb-0">{{++$i}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$customer->status == 0 ? 'text-secondary' : ''}}">{{$customer->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$customer->status == 0 ? 'text-secondary' : ''}}">{{$customer->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$customer->status == 1 ? 'text-success' : 'text-danger'}}">{{$customer->status == 1 ? "Yes" : "No"}}</p>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-secondary text-sm font-weight-bold">{{$customer->created_at}}</span>
                                    </td>
                                    @can('isAdminOrManager')
                                    <td class="text-center">
                                        <button type="button" class="btn {{ $customer->status == 1 ? 'btn-outline-danger' : 'btn-outline-success'}} btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#blockModal{{ $customer->id }}">
                                            {{ $customer->status == 1 ? 'Disable' : 'Enable'}}
                                        </button>
                                    </td>
                                    @endcan
                                </tr>
                                  <!-- block Confirmation Modal -->
                                <div class="modal fade" id="blockModal{{ $customer->id }}" tabindex="-1" aria-labelledby="blockModalLabel{{ $customer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="blockModalLabel{{ $customer->id }}">Confirm Disable</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to {{ $customer->status == 1 ? 'Disable' : 'Enable'}} <strong>{{ $customer->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn bg-gradient-primary">Yes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <span class="text-danger">*No Customer data available. Empty List.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection