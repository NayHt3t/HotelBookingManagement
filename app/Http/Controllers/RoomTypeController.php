<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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

        $room_types = RoomType::all();
        return view('admin.room-types.room-types', ['room_types'=>$room_types]);

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
        //

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'facilities' => 'nullable|string',
            'num_rooms' => 'required|integer|min:1',
            'num_people' => 'required|integer|min:1',
            'extrabed_status' => 'required|boolean',
        ],
        [
            'category_id.required' => 'Select a category for the room type.',
            'category_id.exists' => 'The selected category does not exist.',
            'name.required' => 'Enter the room type name.',
            'name.max' => 'The name must not exceed 255 characters.',
            'num_rooms.required' => 'Enter the number of rooms.',
            'num_rooms.integer' => 'The number of rooms must be an integer.',
            'num_rooms.min' => 'The number of rooms must be at least 1.',
            'num_people.required' => 'Enter the number of people allowed.',
            'num_people.integer' => 'The number of people must be an integer.',
            'num_people.min' => 'The number of people must be at least 1.',
            'extrabed_status.required' => 'Specify if extra beds are allowed.',
            'extrabed_status.boolean' => 'Extra bed status must be true or false.',
        ]);

        RoomType::create($request->except('_token'));

        // Redirect to the categories index page with a success message
        return redirect()->route('room-types.index')->with('success', 'Room Type is successfully added.');


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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        //
        $categories = Category::all();
        return view('admin.room-types.edit-room-type',['roomType'=>$roomType,'categories'=>$categories]);

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
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'facilities' => 'nullable|string',
        'num_rooms' => 'required|integer|min:1',
        'num_people' => 'required|integer|min:1',
        'extrabed_status' => 'required|boolean',
    ], [
        'category_id.required' => 'Select a category for the room type.',
        'category_id.exists' => 'The selected category does not exist.',
        'name.required' => 'Enter the room type name.',
        'name.max' => 'The name must not exceed 255 characters.',
        'num_rooms.required' => 'Enter the number of rooms.',
        'num_rooms.integer' => 'The number of rooms must be an integer.',
        'num_rooms.min' => 'The number of rooms must be at least 1.',
        'num_people.required' => 'Enter the number of people allowed.',
        'num_people.integer' => 'The number of people must be an integer.',
        'num_people.min' => 'The number of people must be at least 1.',
        'extrabed_status.required' => 'Specify if extra beds are allowed.',
        'extrabed_status.boolean' => 'Extra bed status must be true or false.',
        'status.required' => 'Select the status of the room type.',
        // 'status.in' => 'The status must be either available or unavailable.',
    ]);

    // Find the room type by ID
    $roomType = RoomType::find($id);

    // Update fields manually
    $roomType->name = $request->input('name');
    $roomType->facilities = $request->input('facilities');
    $roomType->num_rooms = $request->input('num_rooms');
    $roomType->num_people = $request->input('num_people');
    $roomType->extrabed_status = $request->input('extrabed_status');
  //  $roomType->status = $request->input('status');

    // Save the updated record
    $roomType->save();

    // Redirect back to the room types index page with a success message
    return redirect()->route('room-types.index')->with('success', 'Room type updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $roomType = RoomType::find($id);

        try{
            $roomType->delete();
        }
        catch(QueryException $e){

            return redirect()->route('room-types.index')->with(["success"=>"Room Type can't be deleted ."]);

        }
       
        return redirect()->route('room-types.index')->with(["success"=>"Room Types is successfully deleted."]);

    }
}
