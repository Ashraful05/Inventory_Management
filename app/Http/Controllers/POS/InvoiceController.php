<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function AllInvoice()
    {
        $allData = Invoice::with('payment')
            ->orderby('date','desc')
            ->orderby('id','desc')
            ->where('status',1)
            ->get();
//        return $allData;
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
            return redirect()->back()->with($notification);
        }
        else{
            if($request->paid_amount > $request->estimated_amount){
                $notification = [
                    'alert-type'=>'error',
                    'message'=>'Sorry Paid Amount is Greater than total price',
                ];
                return redirect()->back()->with($notification);
            }else{
                $invoice = new Invoice();
                $invoice->invoice_no = $request->invoice_no_id;
                $invoice->date = date('Y-m-d',strtotime($request->date));
                $invoice->description = $request->description;
                $invoice->status = 0;
                $invoice->created_by = Auth::user()->id;
                //dd($invoice);
//                if($invoice->save()){
//                    echo 'save';
//                }else{
//                    echo 'could not save date';
//                }
//
//                exit();

                DB::transaction(function() use($request,$invoice){
                    if ($invoice->save()) {
                        $count_category = count($request->category_id);
                        for ($i=0; $i < $count_category; $i++) {

                            $invoice_details = new InvoiceDetail();
                            $invoice_details->date = date('Y-m-d',strtotime($request->date));
                            $invoice_details->invoice_id = $invoice->id;
                            $invoice_details->category_id = $request->category_id[$i];
                            $invoice_details->product_id = $request->product_id[$i];
                            $invoice_details->selling_quantity = $request->selling_quantity[$i];
                            $invoice_details->unit_price = $request->unit_price[$i];
                            $invoice_details->selling_price = $request->selling_price;
                            $invoice_details->status = '1';
                            $invoice_details->save();
                        }

                        if ($request->customer_id == '0') {
                            $customer = new Customer();
                            $customer->name = $request->name;
                            $customer->mobile_no = $request->mobile_no;
                            $customer->email = $request->email;
                            $customer->save();
                            $customer_id = $customer->id;
                        } else{
                            $customer_id = $request->customer_id;
                        }

                        $payment = new Payment();
                        $payment_details = new PaymentDetail();

                        $payment->invoice_id = $invoice->id;
                        $payment->customer_id = $customer_id;
                        $payment->paid_status = $request->paid_status;
                        $payment->discount_amount = $request->discount_amount;
                        $payment->total_amount = $request->estimated_amount;

                        if ($request->paid_status == 'full_paid') {
                            $payment->paid_amount = $request->estimated_amount;
                            $payment->due_amount = '0';
                            $payment_details->current_paid_amount = $request->estimated_amount;
                        } elseif ($request->paid_status == 'full_due') {
                            $payment->paid_amount = '0';
                            $payment->due_amount = $request->estimated_amount;
                            $payment_details->current_paid_amount = '0';
                        }elseif ($request->paid_status == 'partial_paid') {
                            $payment->paid_amount = $request->paid_amount;
                            $payment->due_amount = $request->estimated_amount - $request->paid_amount;
                            $payment_details->current_paid_amount = $request->paid_amount;
                        }
                        $payment->save();

                        $payment_details->invoice_id = $invoice->id;
                        $payment_details->date = date('Y-m-d',strtotime($request->date));
                        $payment_details->save();
                    }

                });

            } // end else

        }
        $notification = array(
            'message' => 'Invoice Data Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('invoice_pending_list')->with($notification);

    }

    public function InvoicePendingList()
    {
        $allData = Invoice::orderBy('date','desc')->orderBy('id','desc')->where('status',0)->get();
        return view('admin.invoice.invoice_pending_list',compact('allData'));
    }
    public function DeleteInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);
        InvoiceDetail::where('invoice_id',$invoice->id)->delete();
        Payment::where('invoice_id',$invoice->id)->delete();
        PaymentDetail::where('invoice_id',$invoice->id)->delete();
        $invoice->delete();
        $notification = array(
            'message' => 'Invoice Data Deleted Successfully',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
