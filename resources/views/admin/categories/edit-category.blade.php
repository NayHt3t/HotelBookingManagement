@extends('layouts.user_type.auth')

@section('content')
<div id="wrapper" class="">
    <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2>Create Category</h2>
                <form action="{{route('categories.update',$category->id)}}" method="post">
                    @method("put")
                    @csrf
                    <div class="mt-4">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" name="name" id="" class="form-control" value="{{$category->name}}">
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{route('categories.index')}}" class="btn btn primary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



@endsection