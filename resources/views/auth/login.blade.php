@extends('layouts.auth-master')

@section('content')

<h1 class="text-center">Login Form</h1>

<form action="/login" method="post" class="col-lg-6 offset-lg-3">
@csrf

    <div class="form-group mb-2">
        <label for="" class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <div class="form-group mb-2">
        <label for="" class="form-label">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <a href="/" class="btn btn-md btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-md btn-primary float-end">Submit</button>

</form>

@endsection