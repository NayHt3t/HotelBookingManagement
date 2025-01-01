@extends('layouts.user_type.auth') 
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Create New Room</h2>
                <form action="{{ route('rooms.store') }}" method="POST">
                    @csrf

                    <!-- Room Type -->
                    <div class="form-group mt-3">
                        <label for="room_type_id">Room Type</label>
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select Room Type</option>
                            @foreach($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}">
                                    {{ $roomType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Room Number -->
                    <div class="form-group mt-3">
                        <label for="room_number">Room Number</label>
                        <input type="text" name="room_number" id="room_number" class="form-control" 
                            value="{{ old('room_number')}}" required>
                        @error('room_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div class="form-group mt-3">
                        <label for="room_number">Location</label>
                        <input type="text" name="location" id="room_number" class="form-control" 
                            value="{{ old('location')}}" required>
                        @error('location')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" >Available</option>
                            <option value="0">Unavailable</option>
                            <option value="2">Booking</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
