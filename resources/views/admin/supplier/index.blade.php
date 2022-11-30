@extends('admin.admin_master')
@section('title','All Supplier')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Supplier All Data </h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('supplier.create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Supplier </a> <br>  <br>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Name</th>
                                    <th>Mobile Number </th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Action</th>

                                </thead>


                                <tbody>

                                @foreach($suppliers as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->mobile_no }} </td>
                                        <td> {{ $item->email }} </td>
                                        <td> {{ $item->address }} </td>
                                        <td>
                                            <a href="{{ route('supplier.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('supplier.destroy',$item->id) }}" id="form_select" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger" title="Delete Data"> <i class="fas fa-trash-alt"></i> </button>
                                            </form>

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
