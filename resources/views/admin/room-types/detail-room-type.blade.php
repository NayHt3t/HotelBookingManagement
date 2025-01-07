@extends('layouts.user_type.auth')
@section('content')
<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center">
            <h4>{{ $roomType->name }} - Room Type Details</h4>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Left Column for Room Type Details -->
                <div class="col-md-6">
                    <p><strong>Category:</strong> {{ $roomType->category->name }}</p>
                    <p><strong>Number of Rooms:</strong> {{ $roomType->num_rooms }}</p>
                    <p><strong>People per Room:</strong> {{ $roomType->num_people }}</p>
                    <p><strong>Extra Bed Available:</strong> {{ $roomType->extrabed_status ? 'Yes' : 'No' }}</p>
                    <p><strong>Status:</strong>
                        @if($roomType->status == 1)
                        <span class="badge bg-success">Available</span>
                        @elseif($roomType->status == 2)
                        <span class="badge bg-warning text-dark">Booking</span>
                        @else
                        <span class="badge bg-secondary">Unavailable</span>
                        @endif
                    </p>
                    <p><strong>Facilities:</strong> {{ $roomType->facilities }}</p>
                    <p><strong>Description:</strong> {{ $roomType->description }}</p>
                </div>

                <!-- Right Column for Featured Image, Gallery -->
                <div class="col-md-6 position-relative">
                    <!-- Featured Image with Hover to Upload -->
                    <h5 class="fw-bold mb-3">Featured Image</h5>
                    <div class="position-relative">
                        <!-- Featured Image with Overlay for Upload Prompt -->
                        <img src="{{ asset('storage/featured_images/' . $roomType->featured_image) }}" alt="Featured Image" class="img-fluid rounded mb-4" id="featuredImage" style="cursor: pointer;">
                        <br>
                        <button class="btn btn-success rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#upload_featured_image">view</button>
                        <button class="btn btn-success rounded-pill mt-2" data-bs-toggle="modal" data-bs-target="#upload_gallery">Add Gallery</button>


                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Modal for Uploading Featured Image -->
                    <div class="modal fade" id="upload_featured_image" tabindex="-1" aria-labelledby="upload_featured_image_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="upload_featured_image_label">Upload Featured Image</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body position-relative">
                                    <!-- Display Current Featured Image -->
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/featured_images/' . $roomType->featured_image) }}"
                                            alt="Featured Image"
                                            class="img-fluid rounded mb-4"
                                            id="featuredImagePreview"
                                            style="cursor: pointer; width: 100%; height: auto;">

                                        <!-- Upload Icon -->
                                        <label for="featured_image_input"
                                            class="position-absolute top-50 end-0 translate-middle-y me-2 btn btn-light border rounded-circle p-2"
                                            style="cursor: pointer;">
                                            <i class="fas fa-upload"></i>
                                        </label>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('room-types.updateFeaturedImage', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <input type="file"
                                            name="featured_image"
                                            id="featured_image_input"
                                            class="d-none"
                                            accept="image/*">

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- Modal for Uploading Multiple Gallery Images -->
                    <div class="modal fade" id="upload_gallery" tabindex="-1" aria-labelledby="upload_gallery_label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="upload_gallery_label">Upload Gallery Images</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- File Input Trigger -->
                                    <label for="gallery_images_input" class="btn btn-light border rounded-circle p-2">
                                        <img src="{{ asset('storage/icons/upload.png') }}" alt="Upload Icon" class="img-fluid" style="max-width: 40px;">
                                    </label>

                                    <!-- Hidden File Input -->
                                    <input type="file" name="gallery_images[]" id="gallery_images_input" class="d-none" accept="image/*" multiple>

                                    <!-- Selected Image Previews -->
                                    <div id="galleryImagePreviews" class="d-flex overflow-auto mt-3"></div>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('room-types.addGallery', $roomType->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="file" name="gallery_images[]" id="hidden_gallery_input" class="d-none" accept="image/*" multiple>

                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>





                    <!-- Image Gallery -->
                    @if($roomType->gallery)
                    <h5 class="fw-bold mb-3">Gallery</h5>
                    <div class="row g-3">
                        @foreach(array_slice(explode(',', $roomType->gallery), 0, 3) as $image)
                        <div class="col-md-4 position-relative">
                            <img src="{{ asset('storage/gallery/' . trim($image)) }}" alt="Gallery Image" class="img-fluid rounded shadow-sm">
                            <!-- Delete Button (X) -->
                            <button type="button" class="btn btn-outline-secondary btn-sm position-absolute top-0 end-0 me-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $loop->index }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $loop->index }}">Confirm Deletion</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this image?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('room-types.removeGallery', ['image' => trim($image),'id'=>$roomType->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>

                <!-- More Image Gallery -->
                @if($roomType->gallery)
                <h5 class="fw-bold mb-3">More Images</h5>
                <div class="row g-3">
                    @foreach(explode(',', $roomType->gallery) as $image)
                    <div class="col-md-4 position-relative">
                        <img src="{{ asset('storage/gallery/' . trim($image)) }}" alt="Gallery Image" class="img-fluid rounded shadow-sm covered" style="object-fit: cover; width: 100%; height: 100%;">
                        <!-- Delete Button (X) -->
                        <button type="button" class="btn btn-outline-secondary btn-sm position-absolute top-0 end-0 me-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $loop->index }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $loop->index }}">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this image?
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('room-types.removeGallery', ['image' => trim($image),'id'=>$roomType->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>



            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('room-types.index') }}" class="btn btn-outline-success px-4 py-2"><i class="fas fa-arrow-left"></i></a>
                <a href="{{ route('room-types.index') }}" class="btn btn-outline-secondary px-4 py-2">Back to Room Types</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('featured_image_input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('featuredImagePreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<script>
    // Preview selected images and ensure files are added to the form input
    document.getElementById('gallery_images_input').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('galleryImagePreviews');
        const hiddenInput = document.getElementById('hidden_gallery_input');

        previewContainer.innerHTML = ''; // Clear existing previews
        hiddenInput.files = event.target.files; // Sync files with hidden input

        // Loop through selected files and generate previews
        Array.from(files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('img-fluid', 'rounded', 'me-2');
                img.style = 'max-height: 100px; object-fit: cover;';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>







@endsection
