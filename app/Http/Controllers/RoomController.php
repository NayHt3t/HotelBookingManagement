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
        $rooms= Room::all();
        return view('admin.rooms.rooms', ['rooms'=>$rooms]);

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
        return view('admin.rooms.create-room', ['roomTypes'=>$roomTypes]);
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
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:255',
            'status'=>'required|string|max:255'
        ],
        [
            'room_type_id.required'=>'Select Room Type',
             'room_number.required'=>'Enter room number',
              'status.required'=>'Select Status'

        ]);

        Room::create($request->except('_token'));

        // Redirect to the categories index page with a success message
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
        return view('admin.rooms.edit-room',['roomTypes'=>$roomTypes,'room'=>$room]);

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

        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'room_number' => 'required|string|max:255',
            'status'=>'required|string|max:255'

        ],
        [
            'room_type_id.required'=>'Select Room Type',
            'room_number.required'=>'Enter room number',
            'status.required'=>'Select Status'

        ]);

        $room = Room::find($id);
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

        try{
            $room->delete();
        }
        catch(QueryException $e){

            return redirect()->route('rooms.index')->with(["success"=>" This Room  can't be deleted ."]);

        }
       
        return redirect()->route('rooms.index')->with(["success"=>"Room  is successfully deleted."]);


    }
}
