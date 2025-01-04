@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Add New Facility</h2>
                <div class="mt-2 mb-3">
                    @if($message = Session::get('fail'))
                    <span class="text-warning">{{ $message }}</span>
                    @endif
                </div>
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
                            placeholder="Enter price"
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
                        >
                        @error('compensation')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-md active px-3 text-white">Submit
                        </button>
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
