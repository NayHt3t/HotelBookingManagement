@extends('layouts.auth-master')
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Room Price</h2>
                <div class="mt-2 mb-3">
                    @if($message = Session::get('fail'))
                    <span class="text-warning">{{ $message }}</span>
                    @endif
                </div>
                <form
                    action="{{route('room-prices.update', $room_price->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-3">
                        <label for="room_type_id">Room Type</label>
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select Room Type</option>
                            @foreach($room_types as $room_type)
                                <option
                                    value="{{ $room_type->id }}"
                                    {{ $room_price->room_type_id == $room_type->id ? 'selected' : '' }}
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
                                    {{ $room_price->price_type_id == $price_type->id ? 'selected' : '' }}
                                >
                                    {{ $price_type->name }}
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
                            value="{{ old('price', $room_price->price) }}"
                        >
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('room-prices.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
