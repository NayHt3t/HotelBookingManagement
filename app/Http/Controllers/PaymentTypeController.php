<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $paymentTypes = PaymentType::all();
        return view('admin.payment-types.payment-types',compact('paymentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'method' => 'required|string|max:255', // Ensure 'name' is provided
    ]);

    // Create a new PaymentType instance and save data
    $paymentType = new PaymentType();
    $paymentType->method = $request->method; // Assign the name from the request
    $paymentType->save(); // Save to the database

    // Redirect or return a success response
    return redirect()->back()->with('success', 'Payment Type added successfully!');
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
    public function edit($id)
    {
        //

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
       // dd($request);
        $request->validate([
             'method' => 'required|string|max:255'
        ]

    );

    $paymentType = PaymentType::findOrFail($id);
    $paymentType->method = $request->method;
    $paymentType->save();
    return redirect()->back()->with('success', 'Payment Type Update successfully!');

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
         
    $paymentType = PaymentType::findOrFail($id);

    if (!$paymentType) {
        return redirect()->route('payment-types.index')->with(['unsuccess' => 'Payment Type is not found.']);
    }

     // Check if the category has related RoomType records
     if ($paymentType->payments()->exists()) {
        return redirect()->route('payment-types.index')->with(['unsuccess' => "This Payment Method can't be deleted because it has associated Payments."]);
    }

    try {
        // Delete the category
        $paymentType->delete();
        return redirect()->route('payment-types.index')->with(['success' => 'Payment Type is successfully deleted.']);
    } catch (QueryException $e) {
        return redirect()->route('payment-types.index')->with(['unsuccess' => "An error occurred while deleting the Payment Type."]);
    }
    }
}
