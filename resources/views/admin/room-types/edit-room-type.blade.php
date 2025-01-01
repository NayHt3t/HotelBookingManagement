@extends('layouts.user_type.auth') 
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Edit Room Type</h1>

    <div class="card shadow-lg">
        <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
            <form action="{{ route('room-types.update',$roomType->id) }}" method="POST">
            @method("put")
            @csrf

                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{$roomType->name}}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Number of Rooms -->
                        <div class="form-group mb-3">
                            <label for="num_rooms" class="form-label">Number of Rooms</label>
                            <input type="number" name="num_rooms" id="num_rooms" class="form-control" value="{{ $roomType->num_rooms }}" required>
                            @error('num_rooms')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Extra Bed Status -->
                        <div class="form-group mb-3">
                            <label for="extrabed_status" class="form-label">Extra Bed Available</label>
                            <select name="extrabed_status" id="extrabed_status" class="form-control">
                                <option value="1" {{ $roomType->extrabed_status == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $roomType->extrabed_status == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('extrabed_status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">


                        <!-- Category -->
                        <div class="form-group mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>

                                @if($roomType->category->id == $category->id)
                                <option value="{{$category->id}}" selected>.{{$category->name}}</option>
                                @endif

                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Number of People -->
                        <div class="form-group mb-3">
                            <label for="num_people" class="form-label">Number of People</label>
                            <input type="number" name="num_people" id="num_people" class="form-control" value="{{ $roomType->num_people }}" required>
                            @error('num_people')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ $roomType->status == 0 ? 'selected' : '' }}>Unavailable</option>
                                <option value="1" {{ $roomType->status == 1 ? 'selected' : '' }}>Available</option>
                                <option value="2" {{ $roomType->status == 2 ? 'selected' : '' }}>Booking</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Facilities -->
                <div class="form-group mb-6">
                    <label for="facilities" class="form-label ">Facilities</label>
                    <textarea name="facilities" id="facilities" class="form-control " style="resize: none;" required>{{ $roomType->facilities }}</textarea>
                    @error('facilities')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>





                <div class="d-flex justify-content-center align-items-center mt-3 ">
                    <button class="btn btn-primary w-25">Submit</button>
                </div>



            </form>
        </div>
    </div>
</div>
@endsection