@extends('layouts.user_type.auth')

@section('content')

<div>
    <div class="container-fluid py-4 col-md-8">
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
                <form action="{{route('users.changePassword', $user->id) }}" method="POST" role="form text-left">
                @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="password" class="form-control-label">New Password</label>
                                <div class="position-relative">
                                    <input class="form-control" type="password" id="password" name="password">
                                    <i class="fa fa-eye position-absolute bottom-0 translate-middle end-0 cursor-pointer" id="tooglePassword"></i>
                                    @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="confirm_password" class="form-control-label">Confirm Password</label>
                                <div class="position-relative">
                                    <input class="form-control" type="password" id="confirm_password" name="confirm_password">
                                    <i class="fa fa-eye position-absolute bottom-0 translate-middle end-0 cursor-pointer" id="toogleConPassword"></i>
                                    @error('confirm_password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
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