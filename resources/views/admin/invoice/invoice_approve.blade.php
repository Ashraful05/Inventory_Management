@extends('admin.admin_master')
@section('title','Approved Invoice List')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            @php
                $payment = \App\Models\Payment::where('invoice_id',$invoice->id)->first();
            @endphp
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('invoice_pending_list') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-list-alt"> View All Pending Inovice </i></a>
                            <h4 class="card-title text-center">Approved Inovice List </h4>
                        </div>
                        <div class="card-body">
                            <h4>Invoice No: #{{ $invoice->invoice_no }} - ({{ date('d-m-Y',strtotime($invoice->date)) }})</h4>
                            <table class="mt-2 table table-dark" width="100%">
                                <tbody>
                                <tr>
                                    <td><p>Name: <strong>{{ $payment->customer->name }}</strong></p></td>
                                    <td><p>Email: <strong>{{ $payment->customer->email }}</strong></p></td>
                                    <td><p>Mobile No: <strong>{{ $payment->customer->mobile_no }}</strong> </p></td>
                                </tr>
                                <td></td>
                                <td colspan="3"><p>Description: <strong>{{ $invoice->description }}</strong></p></td>
                                </tbody>
                            </table>

                            <form action="{{ route('invoice_approve_save',$invoice->id) }}" method="post">
                                @csrf
                                <table border="1" class="table table-dark" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">SL.</th>
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center" style="background-color: #8B008B">Current Stock</th>
                                        <th class="text-center">Selling Quantity</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Total Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                    $totalSum = 0;
                                    @endphp
                                    @foreach($invoice['invoiceDetail'] as $row => $details)
                                    <tr>
                                        <input type="hidden" name="category_id[]" value="{{ $details->category_id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $details->product_id }}">
                                        <input type="hidden" name="selling_quantity[{{ $details->id }}]" value="{{ $details->selling_quantity }}">
                                        <td class="text-center">{{ ++$row }}</td>
                                        <td class="text-center">{{ $details->category->name }}</td>
                                        <td class="text-center">{{ $details->product->name }}</td>
                                        <td class="text-center">{{ $details->product->quantity }}</td>
                                        <td class="text-center">{{ $details->selling_quantity}}</td>
                                        <td class="text-center">{{ $details->unit_price}}</td>
                                        <td class="text-center">{{ $details->selling_price}}</td>
                                    </tr>
                                        @php
                                            $totalSum += $details->selling_price;
                                        @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="6">Sub Total</td>
                                        <td class="text-center">{{ $totalSum }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Discount</td>
                                        <td class="text-center">{{ $payment->discount_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Paid Amount</td>
                                        <td class="text-center">{{ $payment->paid_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Due Amount</td>
                                        <td class="text-center">{{ $payment->due_amount }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Grand Total</td>
                                        <td class="text-center">{{ $payment->total_amount }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <button type="submit" class="btn btn-info">Invoice Approve</button>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>


@endsection

