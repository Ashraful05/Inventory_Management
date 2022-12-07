<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::all();
        return view('admin.unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Unit $unit)
    {
        return view('admin.unit.add_edit_unit',compact('unit'));
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
           'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:40',
        ]);
        Unit::insert([
           'name'=>$request->name,
           'status'=>1,
           'created_by'=>Auth::user()->id,
           'created_at'=>Carbon::now()
        ]);
        $notification=[
            'alert-type'=>'success',
            'message'=>"Unit Info Saved!"
        ];
        return redirect()->route('unit.index')->with($notification);
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
    public function edit(Unit $unit)
    {
        return view('admin.unit.add_edit_unit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:40',
        ]);
        $unit->update([
            'name'=>$request->name,
            'updated_by'=>Auth::user()->id,
        ]);
        $notification=[
            'alert-type'=>'info',
            'message'=>"Unit Info Updated!"
        ];
        return redirect()->route('unit.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete();
        $notification=[
          'alert-type'=>'error',
          'message'=>"Unit Info deleted!"
        ];
        return redirect()->route('unit.index')->with($notification);
    }
}
