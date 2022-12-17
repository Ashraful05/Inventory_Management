@extends('admin.admin_master')
@section('title','All Purchase')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Purchase All Data </h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('purchase.create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"></i> Add Purchase</a> <br>  <br>


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

                                @foreach($purchases as $key => $purchase)
                                    <tr>
                                        <td> {{ ++$key}} </td>
                                        <td> {{ $purchase->purchase_no }} </td>
                                        <td> {{ date('d-m-Y',strtotime($purchase->date)) }} </td>
                                        <td> {{ $purchase->supplier->name }}</td>
                                        <td>{{ $purchase->category->name }}</td>
                                        <td>{{ $purchase->product->name }}</td>
                                        <td>{{ $purchase->buying_quantity }}</td>
                                        <td>
                                            @if( $purchase->status==0)
                                                <span class="btn btn-warning">Pending</span>
                                            @else
                                                <span class="btn btn-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($purchase->status == 0)
                                                <form action="{{ route('purchase.destroy',$purchase->id) }}" id="form_select" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger" title="Delete Data"> <i class="fas fa-trash-alt"></i> </button>
                                                </form>
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





