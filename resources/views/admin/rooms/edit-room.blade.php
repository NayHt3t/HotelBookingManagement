@extends('layouts.auth-master')

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

                    <!-- Status -->
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available</option>
                            <option value="unavailable" {{ $room->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                        </select>
                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit and Cancel buttons -->
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Update Room</button>
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
