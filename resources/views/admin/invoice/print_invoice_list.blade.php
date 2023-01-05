@extends('admin.admin_master')
@section('title','Invoice Printing List')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('invoice_create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"></i> Add Invoice </a>
                            <h4 class="card-title text-center">Print Invoice List </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No </th>
                                    <th>Date </th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Action</th>

                                </thead>


                                <tbody>

                                @foreach($allData as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item['payment']['customer']['name'] }} </td>
                                        <td> #{{ $item->invoice_no }} </td>
                                        <td> {{ date('d-m-Y',strtotime($item->date)) }} </td>
                                        <td> {{ $item->description }} </td>
                                        <td>Tk.{{ $item->payment->total_amount }}</td>
                                        <td>
                                            <a href="{{ route('print_by_id',$item->id) }}" title="Print Invoice" class="btn btn-danger btn-sm"><i class="fas fa-print"></i></a>
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

