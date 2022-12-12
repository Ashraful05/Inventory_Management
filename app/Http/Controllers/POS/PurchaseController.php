<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('category','product','supplier')
            ->orderby('date','desc')
            ->orderby('id','desc')
            ->get();
        return view('admin.purchase.index',compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $units = Unit::all();
        return view('admin.purchase.add_edit_purchase',compact('purchase','suppliers','categories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->category_id == null){
            $notification=[
              'alert-type'=>'warning',
              'message'=>'you do not select any item'
            ];
            return redirect()->back()->with($notification);
        }else{
            $countCategory = count($request->category_id);

            for($i=0; $i<$countCategory; $i++)
            {
                Purchase::create([
                   'date'=>date('Y-m-d',strtotime($request->date[$i])),
                    'purchase_no'=>$request->purchase_no[$i],
                    'supplier_id'=>$request->supplier_id[$i],
                    'category_id'=>$request->category_id[$i],
                    'product_id'=>$request->product_id[$i],
                    'buying_quantity'=>$request->buying_quantity[$i],
                    'unit_price'=>$request->unit_price[$i],
//                    'buying_price'=>$request->buying_price[$i],
                    'buying_price'=>floatval($request->buying_quantity[$i] * $request->unit_price[$i]),
                    'description'=>$request->description[$i],
                    'created_by'=>Auth::user()->id,
                    'status'=>0,

                ]);
            }
        }
        $notification = array(
            'message' => 'Data Save Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('purchase.index')->with($notification);
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
    public function edit(Purchase $purchase)
    {
        return view('admin.purchase.add_edit_purchase',compact('purchase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        $notification = [
          'alert-type'=>'error',
          'message'=>'Purchase info deleted!!!'
        ];
        return redirect()->back()->with($notification);
    }

    public function PurchasePending()
    {
        $purchasePendings = Purchase::orderBy('date','desc')->orderBy('id','desc')->where('status','0')->get();
        return view('admin.purchase.purchase_pending',compact('purchasePendings'));
    }
    public function PurchaseApproved($id)
    {
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id',$purchase->product_id)->first();
        $purchaseQty = ((float)($purchase->buying_quantity))+((float)($product->quantity));
        $product->quantity = $purchaseQty;

        if($product->save()){
            Purchase::findOrFail($id)->update(['status'=>1]);
            $notification = array(
                'message' => 'Status Approved Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('purchase.index')->with($notification);
        }
    }


}
