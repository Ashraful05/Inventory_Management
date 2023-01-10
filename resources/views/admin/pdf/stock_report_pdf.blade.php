@extends('admin.admin_master')
@section('title','Daily Stock Report PDF')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-sm-0 text-center">Stock Report</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="invoice-title">

                                        <h3>
                                            <img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="24"/> Ashraf Trade Center
                                        </h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-6 mt-4">
                                            <address>
                                                <strong>Ashraf Trade Center</strong><br>
                                                Saidpur, Nilphamari<br>
                                                ashrafulmd389@gmail.com
                                            </address>
                                        </div>
                                        <div class="col-6 mt-4 text-end">
                                            <address>

                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="p-2">
                                            <h3 class="font-size-16"><strong>Stock Report</strong></h3>
                                        </div>

                                    </div>

                                </div>
                            </div> <!-- end row -->





                            <div class="row">
                                <div class="col-12">
                                    <div>
                                        <div class="">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                    <tr>
                                                        <td><strong>Sl </strong></td>
                                                        <td class="text-center"><strong>Supplier Name  </strong></td>
                                                        <td class="text-center"><strong>Unit </strong></td>
                                                        <td class="text-center"><strong>Category</strong></td>
                                                        <td class="text-center"><strong>Product Name</strong></td>
                                                        <td class="text-center"><strong>In Quantity</strong></td>
                                                        <td class="text-center"><strong>Out Quantity</strong></td>
                                                        <td class="text-center"><strong>Stock  </strong></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <!-- foreach ($order->lineItems as $line) or some such thing here -->

                                                    @foreach($allData as $key => $item)
                                                        @php
                                                            $buyingTotal = \App\Models\Purchase::where(['category_id'=>$item->category_id,'product_id'=>$item->id,'status'=>1])->sum('buying_quantity');
                                                            $sellingTotal = \App\Models\InvoiceDetail::where(['category_id'=>$item->category_id,'product_id'=>$item->id,'status'=>1])->sum('selling_quantity');
                                                        @endphp
                                                        <tr>
                                                            <td class="text-center">{{ $key+1 }}</td>
                                                            <td class="text-center">{{ $item['supplier']['name'] }}</td>
                                                            <td class="text-center">{{ $item->unit->name }}</td>
                                                            <td class="text-center">{{ $item->category->name }}</td>
                                                            <td class="text-center">{{ $item->name }}</td>
                                                            <td class="text-center">{{ $buyingTotal }}</td>
                                                            <td class="text-center">{{ $sellingTotal }}</td>

                                                            <td class="text-center">{{ $item->quantity }}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            @php
                                                $date = new DateTime('now',new DateTimeZone('Asia/Dhaka'));
                                            @endphp
                                            <i >Printing Time: {{ $date->format('F j, Y, g:i a') }}</i>
                                            <div class="d-print-none">
                                                <div class="float-end">
                                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                    <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Download</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> <!-- end row -->

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>


@endsection
