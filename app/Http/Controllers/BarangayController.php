<?php

namespace App\Http\Controllers;

use App\Models\barangay;
use Illuminate\Http\Request;

class BarangayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barangay.view',[
            'barangay' => barangay::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        barangay::insert(['barangay'=>$request->barangay,'shipping'=>$request->shipping]);
        return back()->with('success', 'Barangay Added!');
    }

    public function delete($id)
    {   
        barangay::where('id','=',$id)->delete();
        return back()->with('success', 'Barangay Deleted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function show(barangay $barangay)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function edit(barangay $barangay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        
        barangay::where('id',$id)->update([
            'barangay' => $request->barangay,
            'shipping' => $request->shipping,
        ]);

        return redirect()->back()->with('success', 'Barangay Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barangay  $barangay
     * @return \Illuminate\Http\Response
     */
    public function destroy(barangay $barangay)
    {
        //
    }
}
