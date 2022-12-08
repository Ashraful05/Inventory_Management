@extends('admin.admin_master')
@section('title','All Product')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Product All Data </h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('product.create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Product </a> <br>  <br>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Product Name</th>
                                    <th>Supplier Name</th>
                                    <th>Category Name</th>
                                    <th>Unit Name</th>
                                    <th>Action</th>

                                </thead>
                                <tbody>

                                @foreach($products as $key => $product)
                                    <tr>
                                        <td> {{ ++$key}} </td>
                                        <td> {{ $product->name }} </td>
                                        <td> {{ $product->supplier->name }} </td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->unit->name }}</td>
                                        <td>
                                            <a href="{{ route('product.edit',$product->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('product.destroy',$product->id) }}" id="form_select" method="post">
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




