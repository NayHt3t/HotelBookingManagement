<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PriceType;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

class PriceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $price_types = PriceType::all();
        return view('admin.price-types.price-type',['price_types'=>$price_types]);

        // return view('admin.room-types.create-room-types',['price_types' => $price_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.price-types.create-price-type');
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
            'name' => 'required',
        ],[
            'name.required' => 'Price Type is required'
        ]);
        //character change to lowercase and remove all extra blank space
        $updateName = str(Str::lower($request->name))->squish();
        $priceTypes = PriceType::all();
        // Check price type is already exit or not.
        foreach($priceTypes as $priceType){
            if($priceType->name == $updateName){
                return redirect()->route('price-types.create')->with('fail','Price Type is already exit.');
            }
        }
        PriceType::create(['name'=>$updateName]);

        return redirect()->route('price-types.index')->with('success','Price Type is successfully created');
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
    public function edit(PriceType $priceType)
    {
        return view('admin.price-types.edit-price-type',["priceType"=>$priceType]);
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
            'name' => 'required',
        ],[
            'name.required' => 'Price Type is required'
        ]);

        //character change to lowercase and remove all extra blank space
        $updateName = str(Str::lower($request->name))->squish();

        $priceType = PriceType::find($id);

        $priceTypes = PriceType::all();

        if($priceType->name != $updateName){
        // Check price type is already exit or not.
        foreach($priceTypes as $price_type){
            if($price_type->name == $updateName){
                return redirect()->route('price-types.edit', $priceType)->with('fail','Price Type is already exit.');
            }
        }
        }
        $priceType->name = $updateName;
        $priceType->save();
        return redirect()->route('price-types.index')->with('success','Price Type is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $priceType = PriceType::find($id);
        try{
            $priceType->delete();
        }
        catch(QueryException $e){
            return redirect()->route('price-types.index')->with(["fail"=>"Price Type can't be deleted ."]);
        }
        return redirect()->route('price-types.index')->with(["success"=>"Price Type is successfully deleted."]);

    }
}
