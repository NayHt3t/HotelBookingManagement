@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        @can('isAdmin')<a href="{{route('users.create')}}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>@endcan
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
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
                                        Role
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    @can('isAdmin')
                                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @forelse($users as $user)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-sm font-weight-bold mb-0">{{++$i}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$user->status == 0 ? 'text-secondary' : ''}}">{{$user->name}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$user->status == 0 ? 'text-secondary' : ''}}">{{$user->email}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$user->status == 0 ? 'text-secondary' : ''}}">{{$user->role}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-sm font-weight-bold mb-0 {{$user->status == 1 ? 'text-primary' : 'text-secondary'}}">{{$user->status == 1 ? "Active" : "Not Active"}}</p>
                                    </td>
                                    @can('isAdmin')
                                        <td class="text-center">
                                            <a href="{{route('users.edit', $user)}}" 
                                                data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit user" 
                                                class="btn btn-outline-success rounded-pill">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                                    <!-- Delete Button (Opens the Modal) -->
                                            <button type="button" class="btn btn-outline-danger rounded-pill"
                                                data-bs-toggle="modal"
                                                title="Delete"
                                                data-bs-target="#deleteModal{{ $user->id }}">
                                                <i class="cursor-pointer fas fa-trash text-danger"></i>
                                            </button>
                                            <a href="{{route('users.resetPassword', $user->id)}} " 
                                                data-bs-toggle="tooltip"
                                                data-bs-original-title="Change Password" 
                                                class="btn btn-outline-info">
                                                    change
                                            </a>
                                        </td>
                                    @endcan
                                  
                                </tr> 
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Confirm Deletion</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user <strong>{{ $user->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
                                        <span class="text-danger">*No user data available. Empty List.</span>
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