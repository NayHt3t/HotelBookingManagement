<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $roomTypes = RoomType::all();
        return view('admin.room-types.room-types', ['roomTypes'=>$roomTypes]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $categories = Category::all();
        return view('admin.room-types.create-room-type', ['categories'=>$categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{

   // dd($request);
      // Validate the request
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'facilities' => 'required|string',
            'num_rooms' => 'required|integer',
            'num_people' => 'required|integer',
            'extrabed_status' => 'required|boolean',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'gallery' => 'required|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:0,1,2',
        ],
        [
            // Custom error messages for `gallery`
            'gallery.required' => 'Please upload at least one gallery image.',
            'gallery.array' => 'The gallery must be an array of images.',
        
            // Custom error messages for individual gallery images
            'gallery.*.image' => 'Each file in the gallery must be a valid image.',
            'gallery.*.mimes' => 'Each gallery image must be a file of type: jpeg, png, jpg.',
            'gallery.*.max' => 'Each gallery image must not exceed 2MB in size.',
        ]
       
    );

       
    
        // Handle the featured image
        $featuredImage = $request->file('featured_image');
        $featuredImageName = uniqid() . '.' . $featuredImage->getClientOriginalExtension();
        $featuredImage->storeAs('public/featured_images', $featuredImageName);
    
        // Handle gallery images
        $galleryImages = [];
        foreach ($request->file('gallery') as $galleryImage) {
            $galleryImageName = uniqid() . '.' . $galleryImage->getClientOriginalExtension();
            $galleryImage->storeAs('public/gallery', $galleryImageName);
            $galleryImages[] = $galleryImageName;
        }
    
        // Create the room
        RoomType::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'facilities' => $request->facilities,
            'num_rooms' => $request->num_rooms,
            'num_people' => $request->num_people,
            'extrabed_status' => $request->extrabed_status,
            'featured_image' => $featuredImageName,
            'gallery' => implode(',', $galleryImages), // Save as comma-separated values
            'status' => $request->status,
        ]);
    
        // Return to the previous page with a success message
        return redirect()->route('room-types.index')->with('success', 'Room created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $roomType=RoomType::find($id);
        return view('admin.room-types.detail-room-type',['roomType'=>$roomType]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        
        $categories = Category::all();
        return view('admin.room-types.edit-room-type',['roomType'=>$roomType,'categories'=>$categories]);

    }

    public function removeGallery($id ,$image){
         // Assuming the image exists in the gallery folder
    $imagePath = public_path('storage/gallery/' . $image);
    
    if (file_exists($imagePath)) {
        unlink($imagePath); // Delete the image file
        
        // Update the room type's gallery field by removing the image from the list
        $roomType = RoomType::findOrFail($id); // Use the appropriate method to find the roomType
        $gallery = explode(',', $roomType->gallery);
        $gallery = array_filter($gallery, fn($value) => $value !== $image);
        $roomType->gallery = implode(',', $gallery);
        $roomType->save();
    }
    
    return back()->with('success', 'Image deleted successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
   
   // dd($request);
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'facilities' => 'required|string',
        'num_rooms' => 'required|integer',
        'num_people' => 'required|integer',
        'extrabed_status' => 'required|boolean',
        'status' => 'required|in:0,1,2'
    ]);

            $roomType=RoomType::find($id);
            $roomType->name=$request->input('name');
            $roomType->category_id=$request->input('category_id');
            $roomType->facilities=$request->input('facilities');
            $roomType->num_rooms=$request->input('num_rooms');
            $roomType->num_people=$request->input('num_people');
            $roomType->extrabed_status=$request->input('extrabed_status');
            $roomType->status=$request->input('status');
            $roomType->save();
    
    // Redirect back to the room types index page with a success message
    return redirect()->route('room-types.index')->with('success', 'Room Type updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the RoomType
        $roomType = RoomType::find($id);
    
        if (!$roomType) {
            return redirect()->route('room-types.index')->with(['unsuccess' => 'Room Type not found.']);
        }
    
        // Check if the RoomType has associated Rooms
        if ($roomType->rooms()->exists()) {
            return redirect()->route('room-types.index')->with(['unsuccess' => "Room Type can't be deleted because it has associated Rooms."]);
        }
    
        try {
            // Delete the RoomType
            $roomType->delete();
            return redirect()->route('room-types.index')->with(['success' => 'Room Type is successfully deleted.']);
        } catch (QueryException $e) {
            return redirect()->route('room-types.index')->with(['unsuccess' => 'An error occurred while deleting the Room Type.']);
        }
    }
    

public function updateFeaturedImage(Request $request, $id)
{


    //dd($request);
    // Validate the uploaded file
    $request->validate([
        'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Find the Room Type by ID
    $roomType = RoomType::findOrFail($id);

    // Handle the file upload
    if ($request->hasFile('featured_image')) {
        // Delete the old image if it exists
        if ($roomType->featured_image && Storage::exists('public/featured_images/' . $roomType->featured_image)) {
            Storage::delete('public/featured_images/' . $roomType->featured_image);
        }

        // Save the new image
        $file = $request->file('featured_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/featured_images', $filename);

        // Update the database
        $roomType->featured_image = $filename;
        $roomType->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Featured image updated successfully!');
    }

    // Redirect back with an error message if no file was uploaded
    return redirect()->back()->with('error', 'Please select an image to upload.');
}

public function addGallery(Request $request, $roomTypeId)
{
    // Validate the uploaded files
    $request->validate([
        'gallery_images' => 'required|array',
        'gallery_images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048', // Adjust file types and sizes as needed
    ]);

    // Find the room type by ID
    $roomType = RoomType::findOrFail($roomTypeId);

    // Process the uploaded images
    $uploadedImages = [];
    foreach ($request->file('gallery_images') as $image) {
        // Ensure the file has been uploaded
        if ($image->isValid()) {
            // Generate a unique file name
            $imageName = uniqid('gallery_', true) . '.' . $image->getClientOriginalExtension();
            
            // Store the image in the 'public/gallery' directory and get the file path
            $image->storeAs('public/gallery', $imageName);

            // Add the image name to the array
            $uploadedImages[] = $imageName;
        }
    }

    // Update the gallery column with the new images
    $existingGallery = $roomType->gallery ? explode(',', $roomType->gallery) : [];
    $newGallery = array_merge($existingGallery, $uploadedImages);  // Merge existing and new images

    // Save the updated gallery images list
    $roomType->gallery = implode(',', $newGallery);
    $roomType->save();

    return redirect()->back()->with('success', 'Gallery updated successfully!');
}


}
