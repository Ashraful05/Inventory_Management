@extends('admin.admin_master')
@section('title','Stock Report')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-sm-0 text-center">Stock Report All</h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('stock_report_pdf') }}" target="_blank" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fa fa-print"> Stock Report Print </i></a> <br>  <br>

                            <h4 class="card-title">Stock Report </h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Supplier Name </th>
                                    <th>Unit</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>In Qty</th>
                                    <th>Out Qty </th>
                                    <th>Stock </th>
                                </thead>
                                <tbody>
                                @foreach($allData as $key => $item)
                                    @php
                                        $buyingTotal = \App\Models\Purchase::where(['category_id'=>$item->category_id,'product_id'=>$item->id,'status'=>1])->sum('buying_quantity');
                                        $sellingTotal = \App\Models\InvoiceDetail::where(['category_id'=>$item->category_id,'product_id'=>$item->id,'status'=>1])->sum('selling_quantity');
                                    @endphp
                                    <tr>
                                        <td> {{ ++$key}} </td>
                                        <td> {{ $item['supplier']['name'] }} </td>
                                        <td> {{ $item['unit']['name'] }} </td>
                                        <td> {{ $item['category']['name'] }} </td>
                                        <td> {{ $item->name }} </td>
                                        <td><span class="btn btn-success">{{ $buyingTotal }}</span></td>
                                        <td><span class="btn btn-info">{{ $sellingTotal }}</span></td>
                                        <td><span class="btn btn-danger">{{ $item->quantity }}</span></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>


@endsection
