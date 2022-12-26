@extends('admin.admin_master')
@section('title','Pending Invoice List')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('invoice_all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> View All Inovice </i></a>
                            <h4 class="card-title text-center">Pending Inovice List </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No </th>
                                    <th>Date </th>
                                    <th>Desctipion</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </thead>


                                <tbody>

                                @foreach($allData as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item['payment']['customer']['name'] }} </td>
                                        <td> #{{ $item->invoice_no }} </td>
                                        <td> {{ date('d-m-Y',strtotime($item->date))  }} </td>


                                        <td>  {{ $item->description }} </td>

                                        <td>  Tk.{{ $item['payment']['total_amount'] }} </td>

                                        <td> @if($item->status == '0')
                                                <span class="btn btn-warning">Pending</span>
                                            @elseif($item->status == '1')
                                                <span class="btn btn-success">Approved</span>
                                            @endif </td>

                                        <td>
                                            @if($item->status == '0')
                                                <a href="{{ route('invoice_approve',$item->id) }}" class="btn btn-dark sm" title="Approved Data" >  <i class="fas fa-check-circle"></i> </a>

                                                <a href="{{ route('invoice_delete',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
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
