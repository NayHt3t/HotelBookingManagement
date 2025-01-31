@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h4>Create User</h4>
                        </div>
                        <a href="{{route('users.index')}}" class="btn btn-outline-danger"><i class="fas fa-times"></i></a>
                    </div>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{route('users.store')}}" method="POST" role="form text-left">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">User Name</label>
                                <div>
                                    <input class="form-control" value="{{old('name')}}" type="text" placeholder="Name" id="user-name" name="name">
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
                                    <input class="form-control" type="email" value="{{old('email')}}"  placeholder="@example.com" id="user-email" name="email">
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <div>
                                    <input class="form-control" type="password"  id="password" name="password">
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password" class="form-control-label">Confirm Password</label>
                                <div>
                                    <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                                        @error('confirm_password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="role" class="form-control-label">Role</label>
                                <div>
                                    <input class="form-control" type="text" value="{{old('role')}}" placeholder="eg.manager" id="role" name="role">
                                        @error('role')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection