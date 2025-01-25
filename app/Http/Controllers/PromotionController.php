<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\RoomPrice;
class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::all();
        return view('admin.promotions.promotion',['promotions'=> $promotions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $room_prices = RoomPrice::all();
        return view('admin.promotions.create-promotion',['room_prices'=> $room_prices]);
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
            'room_price_id' => 'required',
            'discount' => 'required|decimal:0,2',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ],[
            'room_price_id.required' => "Please Choose Room Price",
            'discount.required' => 'Please enter discount',
            'discount.decimal' => "Discount must be only two decimal",
            'start_date.required' => 'Please choose start date',
            'start_date.before_or_equal' => 'Start date should be before or equal End date',
            'end_date.required' => 'Please choose end date',
            'end_date.after_or_equal' => 'End date should be after or equal Start date',
        ]);

        $promotions = Promotion::all();
        foreach($promotions as $promotion){
            if($request->room_price_id == $promotion->room_price_id 
            && $request->discount == $promotion->discount 
            && $request->start_date == $promotion->start_date){
                return redirect()->route('promotions.create')->with('unsuccess','Promotion is already exit.');
            }
        }
        Promotion::create($request->except('_token'));
        return redirect()->route('promotions.index')->with('success','Promotion is successfully created');
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
    public function edit(Promotion $promotion)
    {
        $room_prices = RoomPrice::all();
        return view('admin.promotions.edit-promotion',['room_prices'=> $room_prices, 'promotion'=>$promotion]);
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
            'room_price_id' => 'required',
            'discount' => 'required|decimal:0,2',
            'start_date' => 'required|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ],[
            'room_price_id.required' => "Please Choose Room Price",
            'discount.required' => 'Please enter discount',
            'discount.decimal' => "Discount must be only two decimal",
            'start_date.required' => 'Please choose start date',
            'start_date.before_or_equal' => 'Start date should be before or equal End date',
            'end_date.required' => 'Please choose end date',
            'end_date.after_or_equal' => 'End date should be after or equal Start date',
        ]);

        $promotion = Promotion::findOrFail($id);
        if($promotion->room_price_id != $request->room_price_id
                || $request->discount != $promotion->discount 
                || $request->start_date != $promotion->start_date )
        {
            $promotions = Promotion::all();
            foreach($promotions as $promotion){
                if($request->room_price_id == $promotion->room_price_id 
                && $request->discount == $promotion->discount 
                && $request->start_date == $promotion->start_date){
                    return redirect()->route('promotions.edit', $promotion)->with('unsuccess','Promotion is already exit.');
                }
            }
        }
        $promotion->room_price_id = $request->input('room_price_id');
        $promotion->discount = $request->input('discount');
        $promotion->start_date = $request->input('start_date');
        $promotion->end_date = $request->input('end_date');
        $promotion->save();
        return redirect()->route('promotions.index')->with('success','Promotion is successfully edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        try{
            $promotion->delete();
        }
        catch(QueryException $e){
            return redirect()->route('promotions.index')->with(["unsuccess"=>"Promotion can't be deleted ."]);
        }
        return redirect()->route('promotions.index')->with(["success"=>"Promotion is successfully deleted."]);

    }
}
