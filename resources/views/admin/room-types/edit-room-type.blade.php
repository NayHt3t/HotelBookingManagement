@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>Edit Room Type</h2>
                <form 
                    action="{{route('room-types.update', $roomType->id) }}" 
                    method="POST"
                >
                    @csrf
                    @method('PUT')
                  
                    <div class="form-group mt-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}" 
                                    {{ $roomType->category_id == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="name">Room Type Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            value="{{ old('name', $roomType->name) }}" 
                            placeholder="Enter room type name" 
                            required
                        >
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="facilities">Facilities</label>
                        <textarea 
                            name="facilities" 
                            id="facilities" 
                            class="form-control" 
                            rows="3" 
                            placeholder="List facilities for the room"
                        >{{ old('facilities', $roomType->facilities) }}</textarea>
                        @error('facilities')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="num_rooms">Number of Rooms</label>
                        <input 
                            type="number" 
                            name="num_rooms" 
                            id="num_rooms" 
                            class="form-control" 
                            value="{{ old('num_rooms', $roomType->num_rooms) }}" 
                            required
                        >
                        @error('num_rooms')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="num_people">Number of People</label>
                        <input 
                            type="number" 
                            name="num_people" 
                            id="num_people" 
                            class="form-control" 
                            value="{{ old('num_people', $roomType->num_people) }}" 
                            required
                        >
                        @error('num_people')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="extrabed_status">Extra Bed Status</label>
                        <select name="extrabed_status" id="extrabed_status" class="form-control">
                            <option value="1" {{ $roomType->extrabed_status ? 'selected' : '' }}>Available</option>
                            <option value="0" {{ !$roomType->extrabed_status ? 'selected' : '' }}>Not Available</option>
                        </select>
                        @error('extrabed_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('room-types.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
