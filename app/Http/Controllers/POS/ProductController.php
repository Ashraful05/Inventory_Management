<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('supplier','category','unit')->get();
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.product.add_edit_product',compact('product','suppliers','categories','units'));
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
            'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:50',
        ]);
        Product::create([
           'name'=>$request->name,
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'unit_id'=>$request->unit_id,
            'quantity'=>$request->quantity,
            'created_by'=>Auth::user()->id,
        ]);
        $notification=[
          'alert-type'=>'success',
          'message'=>'Product info saved!!'
        ];
        return redirect()->route('product.index')->with($notification);
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
    public function edit(Product $product)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.product.add_edit_product',compact('product','categories','suppliers','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $request->validate([
            'name'=>'required|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/|max:50',
        ]);
        $product->update([
            'name'=>$request->name,
            'supplier_id'=>$request->supplier_id,
            'category_id'=>$request->category_id,
            'unit_id'=>$request->unit_id,
            'quantity'=>$request->quantity,
            'updated_by'=>Auth::user()->id,
        ]);
        $notification=[
            'alert-type'=>'info',
            'message'=>'Product info updated!!'
        ];
        return redirect()->route('product.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $notification=[
            'alert-type'=>'error',
            'message'=>'Product info deleted!!'
        ];
        return redirect()->back()->with($notification);
    }
}
