<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use Illuminate\Database\QueryException;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::all();
        return view('admin.facilities.facility',['facilities'=> $facilities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.facilities.create-facility');
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
            'price' => 'required|decimal:0,2',
            'compensation' => 'required|decimal:0,2'
        ],[
            'name.required' => "Please enter name for facility",
            'price.required' => 'Please enter price for faciltity',
            'compensation.required' => 'Please enter compensation',
            'price.decimal' => "Price must be only two decimal",
            'compensation.decimal' => 'Compensation must be only two decimal'
        ]);
        Facility::create($request->except('_token'));
        return redirect()->route('facilities.index')->with('success','Facility is successfully created');
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
    public function edit(Facility $facility,)
    {
        return view('admin.facilities.edit-facility',['facility'=>$facility]);
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
            'price' => 'required|decimal:0,2',
            'compensation' => 'required|decimal:0,2'
        ],[
            'name.required' => "Please enter name for facility",
            'price.required' => 'Please enter price for faciltity',
            'compensation.required' => 'Please enter compensation','price.decimal' => "Price must be only two decimal",
            'compensation.decimal' => 'Compensation must be only two decimal'
        ]);
        $facility = Facility::find($id);
        $facility->name = $request->name;
        $facility->price = $request->price;
        $facility->compensation = $request->compensation;
        $facility->save();
        return redirect()->route('facilities.index')->with('success','Facilities is successfully updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facility = Facility::find($id);
        try{
            $facility->delete();
        }
        catch(QueryException $e){
            return redirect()->route('facilities.index')->with(["unsuccess"=>"Facility can't be deleted ."]);
        }
        return redirect()->route('facilities.index')->with(["success"=>"Facility is successfully deleted."]);

    }
}
