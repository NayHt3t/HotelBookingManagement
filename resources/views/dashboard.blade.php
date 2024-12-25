@extends('layouts.auth-master')
@section('content')
<h1>Dashboard</h1>
<a href="{{route('categories.index')}}" class="btn btn-success">Category</a>
<a href="{{route('room-types.index')}}" class="btn btn-success">Room Type</a>
<a href="{{route('rooms.index')}}" class="btn btn-success">Room</a>


@endsection