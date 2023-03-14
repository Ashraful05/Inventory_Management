@extends('admin.admin_master')
@section('title','Paid Customer')
@section('admin')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('customer.paid.pdf') }}" class="btn btn-dark btn-rounded waves-effect waves-light" target="_black" style="float:right;"><i class="fa fa-print"> Print Paid Customer </i></a>
                            <h4 class="card-title">Paid Customer Data </h4>
                        </div>
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Customer Name</th>
                                    <th>Invoice No </th>
                                    <th>Date</th>
                                    <th>Due Amount</th>
                                    <th>Action</th>
                                </thead>

                                <tbody>

                                @foreach($allData as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item['customer']['name'] }} </td>
                                        <td> {{ $item['invoice']['invoice_no'] }}</td>
                                        <td> {{ date('d-m-Y',strtotime($item['invoice']['date'])) }} </td>
                                        <td> {{ $item->due_amount }} </td>
                                        <td>
                                            <a href="{{ route('customer.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fa fa-eye"></i> </a>
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
