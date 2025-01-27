@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h3 class="text-center">Edit Promotion</h3>
                <form
                    action="{{ route('promotions.update', $promotion->id) }}"
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                    <div class="form-group mt-3">
                        <label for="room_price_id">Room Price</label>
                        <select name="room_price_id" id="room_price_id" class="form-control">
                            <option value="">Select Room Price</option>
                            @foreach($room_prices as $room_price)
                                <option
                                    value="{{ $room_price->id }}"
                                    {{ $promotion->room_price_id == $room_price->id ? 'selected' : '' }}
                                >
                                   {{$room_price->roomType->name}} - {{ $room_price->price }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_price_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group mt-3">
                        <label for="discount">Discount</label>
                        <input
                            type="number"
                            name="discount"
                            id="discount"
                            class="form-control"
                            value="{{old('discount', $promotion->discount)}}"
                            step="any"
                        >
                        @error('discount')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="start_date">Start Date</label>
                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            class="form-control"
                            value="{{old('start_date', $promotion->start_date)}}"
                            placeholder="Choose Start Date"
                            step="any"
                        >
                        @error('start_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="end_date">End Date</label>
                        <input
                            type="date"
                            name="end_date"
                            id="end_date"
                            class="form-control"
                            value="{{old('end_date', $promotion->end_date)}}"
                            placeholder="Choose End Date"
                            step="any"
                        >
                        @error('end_date')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary btn-md active ms-3 text-white">Submit
                        </button>
                        <a href="{{ route('promotions.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
