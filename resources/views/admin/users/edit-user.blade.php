@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h4>Edit User</h4>
                        </div>
                        <a href="{{route('users.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                    </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('users.update', $user->id)}}" method="POST" role="form text-left">
                   
                    @csrf
                    @method("PATCH")  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">User Name</label>
                                <div>
                                    <input class="form-control" value="{{old('name', $user->name)}}" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">Email</label>
                                <div>
                                    <input class="form-control" type="email" value="{{old('email', $user->email)}}"  placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-control-label">Role</label>
                                <div>
                                    <input class="form-control" type="text" value="{{old('role', $user->role)}}" placeholder="eg.manager" id="role" name="role">
                                        @error('role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="active" name="status" value="1" {{$user->status == 1 ? 'checked' : ''}}>
                                    <label for="active" class="form-check-label">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="not_active" name="status" value="0" {{$user->status == 0 ? 'checked' : ''}}>
                                    <label for="not_active" class="form-check-label">Not Active</label>
                                </div>   
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection