<?php

namespace App\Http\Controllers;

use App\Models\RoomPrice;
use App\Models\PriceType;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RoomPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_prices = RoomPrice::all();
        return view('admin.room-prices.room-prices',['room_prices' => $room_prices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price_types = PriceType::all();
        $room_types = RoomType::all();
        return view('admin.room-prices.create-room-prices',['price_types' => $price_types, 'room_types' => $room_types]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'price_type_id' => 'required|exists:price_types,id',
            'price' => 'required'
        ],[
            'room_type_id.required' => "You must be select Room Type",
            'price_type_id.required' => "You must be select Price Type",
            'price.required' => "Enter price for this room type",
        ]);

        // Check price for this price type and room type have been already exit in database
        $room_prices = RoomPrice::where('room_type_id',$request->room_type_id)->get();
        foreach($room_prices as $room_price)
        {
            if($room_price->price_type_id == $request->price_type_id){
                return redirect()->route('room-prices.create')->with('fail','Price is already exit for this room type and price type.');
            }
        }
        RoomPrice::create($request->except('_token'));
        return redirect()->route('room-prices.index')->with('success','Room Price is successfully added.');


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
    public function edit(RoomPrice $roomPrice )
    {
        $price_types = PriceType::all();
        $room_types = RoomType::all();
        return view('admin.room-prices.edit-room-prices',['price_types' => $price_types, 'room_types' => $room_types, 'room_price' => $roomPrice]);
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
        $request->validate([
            'room_type_id' => 'required|exists:room_types,id',
            'price_type_id' => 'required|exists:price_types,id',
            'price' => 'required'

        ],[
            'room_type_id.required' => "You must be select Room Type",
            'price_type_id.required' => "You must be select Price Type",
            'price.required' => "Enter price for this room type",
        ]);

        $roomPrice = RoomPrice::find($id);

        if($roomPrice->room_type_id != $request->room_type_id || $roomPrice->price_type_id != $request->price_type_id ){

            $room_prices = RoomPrice::where('room_type_id',$request->room_type_id)->get();

            foreach($room_prices as $room_price){
                if($room_price->price_type_id == $request->price_type_id){
                    return redirect()->route('room-prices.edit', $roomPrice)->with('fail','Price is already exit for this room type and price type.');
                }
            }
        }

        $roomPrice->room_type_id = $request->input('room_type_id');
        $roomPrice->price_type_id = $request->input('price_type_id');
        $roomPrice->price = $request->input('price');

        $roomPrice->save();

        return redirect()->route('room-prices.index')->with('success', 'Room Price updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room_price = RoomPrice::find($id);
        try{
            $room_price->delete();
        }
        catch(QueryException $e){
            return redirect()->route('room-prices.index')->with(["fail"=>"Room Price can't be deleted ."]);
        }
        return redirect()->route('room-prices.index')->with(["success"=>"Room Price is successfully deleted."]);
    }
}
