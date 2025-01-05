@extends('layouts.user_type.auth') 
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Create Room Type</h1>

    <div class="card shadow-lg">
        <div class="card-body" style="max-height: 70vh; overflow-y: auto;">
            <form action="{{ route('room-types.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">

                        <!-- Name -->
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <!-- Number of Rooms -->
                        <div class="form-group mb-3">
                            <label for="num_rooms" class="form-label">Number of Rooms</label>
                            <input type="number" name="num_rooms" id="num_rooms" class="form-control" value="{{ old('num_rooms') }}" required>
                            @error('num_rooms')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Extra Bed Status -->
                        <div class="form-group mb-3">
                            <label for="extrabed_status" class="form-label">Extra Bed Available</label>
                            <select name="extrabed_status" id="extrabed_status" class="form-control">
                                <option value="1" {{ old('extrabed_status') == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('extrabed_status') == 0 ? 'selected' : '' }}>No</option>
                            </select>
                            @error('extrabed_status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Facilities -->
                        <div class="form-group mb-3">
                            <label for="facilities" class="form-label">Facilities</label>
                            <textarea name="facilities" id="facilities" class="form-control " rows="5" style="resize: none;" required>{{ old('facilities') }}</textarea>
                            @error('facilities')
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
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>




                        <!-- Number of People -->
                        <div class="form-group mb-3">
                            <label for="num_people" class="form-label">Number of People</label>
                            <input type="number" name="num_people" id="num_people" class="form-control" value="{{ old('num_people') }}" required>
                            @error('num_people')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Unavailable</option>
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Available</option>
                                <option value="2" {{ old('status', 1) == 2 ? 'selected' : '' }}>Booking</option>
                            </select>
                            @error('status')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Featured Image -->
                        <div class="form-group mb-3">
                            <label for="featured_image" class="form-label">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control" required>
                            @error('featured_image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gallery Images -->
                        <div class="form-group mb-3">
                            <label for="gallery" class="form-label">Gallery Images</label>
                            <input type="file" name="gallery[]" id="gallery" class="form-control" multiple required>
                            @if ($errors->has('gallery'))
                            <p class="text-danger">{{ $errors->first('gallery') }}</p>
                            @endif
                            @if ($errors->has('gallery.*'))
                            @foreach ($errors->get('gallery.*') as $messages)
                            @foreach ($messages as $message)
                            <p class="text-danger">{{ $message }}</p>
                            @endforeach
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>




                <div class="d-flex justify-content-center align-items-center ">
                <button class="btn btn-primary w-25">Submit</button>
                </div>



            </form>
        </div>
    </div>
</div>
@endsection