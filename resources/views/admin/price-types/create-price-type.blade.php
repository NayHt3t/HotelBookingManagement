@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Add Price Type</h2>
                <div class="mt-2 mb-3">
                    @if($message = Session::get('fail'))
                    <span class="text-warning">{{ $message }}</span>
                    @endif
                </div>
                <form
                    action="{{ route('price-types.store') }}"
                    method="POST"
                >
                    @csrf

                    <div class="form-group mt-3">
                        <label for="name">Price Type Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            value="{{old('name')}}"
                            placeholder="Enter price type"
                        >
                        @error('name')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-md active px-3 text-white"> submit
                        </button>
                        <a href="{{ route('price-types.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
