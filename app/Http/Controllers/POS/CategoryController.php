<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin.category.add_edit_category',compact('category'));
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
           'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:50'
        ]);
        Category::insert([
           'name'=>$request->name,
           'created_by'=>Auth::user()->id,
           'created_at'=>Carbon::now()
        ]);
        $notification=[
            'alert-type'=>'success',
            'message'=>"Category Info Saved!"
        ];
        return redirect()->route('category.index')->with($notification);
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
    public function edit(Category $category)
    {
        return view('admin.category.add_edit_category',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:50'
        ]);
       $category->update([
            'name'=>$request->name,
            'updated_by'=>Auth::user()->id,
        ]);
        $notification=[
            'alert-type'=>'info',
            'message'=>"Category Info Updated!"
        ];
        return redirect()->route('category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        $notification=[
            'alert-type'=>'error',
            'message'=>"Category Info Deleted!"
        ];
        return redirect()->route('category.index')->with($notification);
    }
}
