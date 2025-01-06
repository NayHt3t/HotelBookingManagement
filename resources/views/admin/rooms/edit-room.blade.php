@extends('layouts.user_type.auth') 
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Room</h2>

                <!-- Edit Room Form -->
                <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Room Type -->
                    <div class="form-group mt-3">
                        <label for="room_type_id">Room Type</label>
                        <select name="room_type_id" id="room_type_id" class="form-control">
                            <option value="">Select Room Type</option>
                            @foreach($roomTypes as $roomType)
                                <option 
                                    value="{{ $roomType->id }}" 
                                    {{ $room->room_type_id == $roomType->id ? 'selected' : '' }}
                                >
                                    {{ $roomType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_type_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Room Number -->
                    <div class="form-group mt-3">
                        <label for="room_number">Room Number</label>
                        <input 
                            type="text" 
                            name="room_number" 
                            id="room_number" 
                            class="form-control" 
                            value="{{ old('room_number', $room->room_number) }}" 
                            placeholder="Enter room number" 
                            required
                        >
                        @error('room_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                     <!-- Room Location -->
                     <div class="form-group mt-3">
                        <label for="location">Location</label>
                        <input 
                            type="text" 
                            name="room_number" 
                            id="room_number" 
                            class="form-control" 
                            value="{{ old('location', $room->location) }}" 
                            placeholder="Enter room number" 
                            required
                        >
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group mt-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $room->status == 0 ? 'selected' : '' }}>Unavailable</option>
                                <option value="1" {{ $room->status == 1 ? 'selected' : '' }}>Available</option>
                                <option value="2" {{ $room->status == 2 ? 'selected' : '' }}>Booking</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                    <!-- Submit and Cancel buttons -->
                    <div class="form-group mt-4 d-flex justify-content-end" >
                    <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success ms-3">Update Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
