@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center">Add New Facility</h3>
                <form
                    action="{{ route('facilities.store') }}"
                    method="POST"
                >
                    @csrf
                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{old('name')}}"
                            placeholder="Enter name"
                        >
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="price">Price</label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control"
                            value="{{old('price')}}"
                            placeholder="Enter room price"
                            step="any"
                        >
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="compensation">Compensation</label>
                        <input
                            type="number"
                            name="compensation"
                            id="compensation"
                            class="form-control"
                            value="{{old('compensation')}}"
                            placeholder="Enter compensation"
                            step="any"
                        >
                        @error('compensation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-md active ms-3 text-white">Submit
                        </button>
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
