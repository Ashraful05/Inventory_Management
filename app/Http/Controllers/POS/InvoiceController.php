<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function AllInvoice()
    {
        $allData = Invoice::orderby('date','desc')->orderby('id','desc')->get();
        return view('admin.invoice.all_invoice',compact('allData'));
    }
    public function CreateInvoice()
    {
        $customers = Customer::all();
        $categories = Category::all();
        $invoiceData = Invoice::orderBy('id','desc')->first();
        if($invoiceData === null){
            $firstInvoice = '0';
            $invoiceNo = $firstInvoice + 1;
        }else{
            $invoiceData = Invoice::orderBy('id','desc')->first()->invoice_no;
            $invoiceNo = $invoiceData+1;
        }
        $date = date('Y-m-d');
        return view('admin.invoice.create_invoice',compact('customers','categories','invoiceNo','date'));
    }
    public function SaveInvoice(Request $request)
    {
        if($request->category_id == null){
            $notification = [
              'alert-type'=>'warning',
              'message'=>'Sorry You do not select any item',
            ];
//            return redirect()->back()->with($notification);
        }
        else{
            if($request->paid_amount > $request->estimated_amount){
                $notification = [
                    'alert-type'=>'error',
                    'message'=>'Sorry Paid Amount is Greater than total price',
                ];

            }else{

            }
        }
        return redirect()->back()->with($notification);
    }
}
