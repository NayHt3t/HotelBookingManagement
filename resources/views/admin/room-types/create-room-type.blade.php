@extends('layouts.user_type.auth')
@section('content')

<div id="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <h2>{{ isset($roomtype) ? 'Edit Room Type' : 'Add New Room Type' }}</h2>
                <form 
                    action="{{ route('room-types.store') }}" 
                    method="POST"
                >
                    @csrf
                  
                    <div class="form-group mt-3">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option 
                                    value="{{ $category->id }}" 
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="name">Room Type Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            value="" 
                            placeholder="Enter room type name" 
                            required
                        >
                        @error('name')
                    <span class="text-danger">{{$message}}</span>
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
                        ></textarea>
                        @error('facilities')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="num_rooms">Number of Rooms</label>
                        <input 
                            type="number" 
                            name="num_rooms" 
                            id="num_rooms" 
                            class="form-control" 
                            value="" 
                            required
                        >
                        @error('num_rooms')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="num_people">Number of People</label>
                        <input 
                            type="number" 
                            name="num_people" 
                            id="num_people" 
                            class="form-control" 
                            value="" 
                            required
                        >
                        @error('num_people')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="extrabed_status">Extra Bed Status</label>
                        <select name="extrabed_status" id="extrabed_status" class="form-control">
                            <option value="1" >Available</option>
                            <option value="0">Not Available</option>
                        </select>
                        @error('extrabed_status')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    </div>

    

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-success"> submit
                        </button>
                        <a href="{{ route('room-types.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
