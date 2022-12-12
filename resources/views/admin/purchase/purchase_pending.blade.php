@extends('admin.admin_master')
@section('title','Pending Purchase')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Pending Purchase Data </h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('purchase.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">All Purchase </a> <br>  <br>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Purhase No</th>
                                    <th>Date </th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </thead>


                                <tbody>

                                @foreach($purchasePendings as $key => $purchasePending)
                                    <tr>
                                        <td> {{ ++$key}} </td>
                                        <td> {{ $purchasePending->purchase_no }} </td>
                                        <td> {{ date('d-m-Y',strtotime($purchasePending->date)) }} </td>
                                        <td> {{ $purchasePending->supplier->name }}</td>
                                        <td>{{ $purchasePending->category->name }}</td>
                                        <td>{{ $purchasePending->product->name }}</td>
                                        <td>{{ $purchasePending->buying_quantity }}</td>
                                        <td>
                                            @if( $purchasePending->status==0)
                                                <span class="btn btn-warning">Pending</span>
                                            @else
                                                <span class="btn btn-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($purchasePending->status == '0')
                                                <a href="{{ route('purchase.approved',$purchasePending->id) }}" class="btn btn-danger sm" title="Approved" id="ApproveBtn">  <i class="fas fa-check-circle"></i> </a>
                                            @else

                                            @endif
                                        </td>

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






