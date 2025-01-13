<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rooms = Room::all();
        return view('admin.rooms.rooms', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roomTypes = RoomType::all();
        return view('admin.rooms.create-room', ['roomTypes' => $roomTypes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|in:0,1,2',
        ], [
            'room_type_id.required' => 'Select Room Type',
            'room_number.required' => 'Enter Room number',
            'location.required' => 'Enter Room location',
            'status.required' => 'Select Status',
        ]);

        $currentRoomTypeId = $request->input('room_type_id');
        $roomType = RoomType::findOrFail($currentRoomTypeId);
        // Create the room
        Room::create($request->except('_token'));

        // Count the current number of rooms for the given room type
        $currentRoomCount = Room::where('room_type_id', $currentRoomTypeId)->count();
        $availableRoomCount = Room::where('room_type_id', $currentRoomTypeId)
                        ->where('status', 1)
                        ->count();

        $roomType->num_rooms = $currentRoomCount;
        $roomType->available_rooms = $availableRoomCount;
        $roomType->save();


        // Redirect with success message
        return redirect()->route('rooms.index')->with('success', 'Room is successfully added.');
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
    public function edit(Room $room)
    {
        //
        $roomTypes = RoomType::all();
        return view('admin.rooms.edit-room', ['roomTypes' => $roomTypes, 'room' => $room]);
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
        //

        $request->validate(
            [
                'room_type_id' => 'required|exists:room_types,id',
                'room_number' => 'required|string|max:255',
                'status' => 'required|string|max:255'

            ],
            [
                'room_type_id.required' => 'Select Room Type',
                'room_number.required' => 'Enter room number',
                'status.required' => 'Select Status'

            ]
        );

        $room = Room::find($id);
        // Update available_room in roomType table
        $roomType = RoomType::findOrFail($request->input('room_type_id'));
        if($room->status != $request->input('status')){
            if($request->input('status') == 1){
                $update_status = $roomType->available_rooms + 1;
            }else if($request->input('status') == 0 || $request->input('status') == 2 ){
                $update_status = $roomType->available_rooms - 1;
            }
            $roomType->available_rooms = $update_status;
            $roomType->save();
        }
        $room->room_type_id = $request->input('room_type_id');
        $room->room_number = $request->input('room_number');
        $room->status = $request->input('status');
        $room->save();
        
        return redirect()->route('rooms.index')->with('success', 'Room  updated successfully.');
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
        $room = Room::find($id);
        $roomTypeId =  $room->room_type_id;
        $roomType = RoomType::findOrFail($roomTypeId);


        try {
            $room->delete();
            // Count the current number of rooms for the given room type
            $currentRoomCount = Room::where('room_type_id', $roomTypeId)->count();
            $roomType->num_rooms = $currentRoomCount;
            $roomType->save();
        } catch (QueryException $e) {

            return redirect()->route('rooms.index')->with(["success" => " This Room  can't be deleted ."]);
        }

        return redirect()->route('rooms.index')->with(["success" => "Room  is successfully deleted."]);
    }
}
