<?php

namespace App\Http\Controllers;

use App\Models\pcategory;
use Illuminate\Http\Request;

class PcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        pcategory::insert(['categoryName'=>$request->category]);
        return redirect('admin/category')->with('success', 'Category Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $category = pcategory::all();
       
        return view("category.view",['category' => $category]);
    }

    public function delete($id)
    {   
        pcategory::where('id','=',$id)->delete();
        return redirect('admin/category')->with('success', 'Category Deleted!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(pcategory $pcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pcategory $pcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pcategory  $pcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(pcategory $pcategory)
    {
        
    }
}
