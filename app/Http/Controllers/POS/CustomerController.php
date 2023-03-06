<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $customers = Customer::latest()->get();
        return view('admin.customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Customer $customer)
    {
//        return $customer->all();
        return view('admin.customer.add_edit_customer',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required|string|max:120',
            'mobile_no'=>'required|unique:customers',
        ]);

        if($request->file('customer_image'))
        {
            $image = $request->file('customer_image');
            $name_gen = date('Y_m_d_Hi_').'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430,327)->save('upload/customer/'.$name_gen);
            $imageUrl = 'upload/customer/'.$name_gen;
            Customer::insert([
                'customer_image'=>$imageUrl,
                'name'=>$request->name,
                'mobile_no'=>$request->mobile_no,
                'email'=>$request->email,
                'address'=>$request->address,
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()
            ]);
            $notification=[
                'alert-type'=>'success',
                'message'=>'Customer info Saved with Image!!'
            ];
//            return redirect()->route('customer.index')->with($notification);
        }else{
            Customer::insert([
                'name'=>$request->name,
                'mobile_no'=>$request->mobile_no,
                'email'=>$request->email,
                'address'=>$request->address,
                'created_by'=>Auth::user()->id,
                'created_at'=>Carbon::now()
            ]);
            $notification = [
                'alert-type'=>'success',
                'message'=>'Customer Info Saved without Image!!'
            ];
        }
        return redirect()->route('customer.index')->with($notification);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.add_edit_customer',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Customer $customer)
    {
        $oldImage = $request->old_image;
        if($request->file('customer_image'))
        {
           if(!empty($oldImage)){unlink($oldImage);}
           $image = $request->customer_image;
           $name_gen = date('Y_m_d_Hi').'.'.$image->getClientOriginalExtension();
           Image::make($image)->resize('250','250')->save('upload/customer/'.$name_gen);
           $imageUrl = 'upload/customer/'.$name_gen;
           $customer->update([
              'customer_image'=>$imageUrl,
               'name'=>$request->name,
              'mobile_no'=>$request->mobile_no,
               'email'=>$request->email,
               'address'=>$request->address,
               'created_by'=>Auth::user()->id,
           ]);
            $notification = [
                'alert-type'=>'info',
                'message'=>'Customer Info updated with Image!!'
            ];
        }else{
            $customer->update([
                'name'=>$request->name,
                'mobile_no'=>$request->mobile_no,
                'email'=>$request->email,
                'address'=>$request->address,
                'created_by'=>Auth::user()->id,
            ]);
            $notification = [
                'alert-type'=>'info',
                'message'=>'Customer Info updated without Image!!'
            ];
        }
        return redirect()->route('customer.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer)
    {
        $image = $customer->customer_image;
        if($image){
            unlink($image);
            $customer->delete();
            $notification=[
                'alert-type'=>'error',
                'message'=>'Blog info deleted with image!!!!'
            ];
        }
        else{
            $customer->delete();
            $notification=[
                'alert-type'=>'error',
                'message'=>'Blog info deleted without image!!!!'
            ];
        }

        return redirect()->route('customer.index')->with($notification);

    }
    public function CustomerCreditReport()
    {
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.customer.credit_customer',compact('allData'));
    }

    public function CustomerCreditReportPDF()
    {
        $allData = Payment::whereIn('paid_status',['full_due','partial_paid'])->get();
        return view('admin.pdf.credit_customer_pdf',compact('allData'));
    }
    public function CustomerEditInvoice($invoice_id)
    {
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.customer.edit_customer_invoice',compact('payment'));
    }
    public function CustomerUpdateInvoice(Request $request,$invoice_id)
    {
        if($request->new_paid_amount < $request->paid_amount)
        {
            $notification = [
              'message'=>'Sorry you already paid maximum amount',
              'alert-type'=>'error'
            ];
            return redirect()->back()->with($notification);
        }else{
            $payment = Payment::where('invoice_id',$invoice_id)->first();
            $paymentDetails = new PaymentDetail();
            $payment->paid_status = $request->paid_status;

            if($request->paid_status == 'full_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->new_paid_amount;
                $payment->due_amount = '0';
                $paymentDetails->current_paid_amount = $request->new_paid_amount;
            }elseif ($request->paid_status == 'partial_paid'){
                $payment->paid_amount = Payment::where('invoice_id',$invoice_id)->first()['paid_amount']+$request->paid_amount;
                $payment->due_amount = Payment::where('invoice_id',$invoice_id)->first()['due_amount']-$request->paid_amount;
                $paymentDetails->current_paid_amount = $request->paid_amount;
            }
            $payment->save();
            $paymentDetails->invoice_id = $invoice_id;
            $paymentDetails->date = date('Y-m-d',strtotime($request->date));
            $paymentDetails->updated_by = Auth::user()->id;
            $paymentDetails->save();
            $notification = [
                'alert-type'=>'info',
                'message'=>'Info Updated successfully!!'
            ];
            return redirect()->route('customer.credit.report')->with($notification);

        }

    }
    public function CustomerInvoiceDetailsPDF($invoice_id)
    {
        $payment = Payment::where('invoice_id',$invoice_id)->first();
        return view('admin.pdf.customer_invoice_details_pdf',compact('payment'));
    }
}
