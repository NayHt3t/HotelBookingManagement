@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center">Add New Room Type</h3>
                <form
                    action="{{ route('room-prices.store') }}"
                    method="POST"
                >
                    @csrf

                    <div class="form-group mt-3">
                        <label for="room_type_id">Room Type</label>
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select Room Type</option>
                            @foreach($room_types as $room_type)
                                <option
                                    value="{{ $room_type->id }}"
                                >
                                    {{ $room_type->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="price_type_id">Price Type</label>
                        <select name="price_type_id" id="price_type_id" class="form-control">
                            <option value="">Select Price Type</option>
                            @foreach($price_types as $price_type)
                                <option
                                    value="{{ $price_type->id }}"
                                >
                                    {{ Str::ucfirst($price_type->name) }}
                                </option>
                            @endforeach
                        </select>
                        @error('price_type_id')
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
                            step="any"
                        >
                        @error('price')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-md active ms-3 text-white">Submit
                        </button>
                        <a href="{{ route('room-prices.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
