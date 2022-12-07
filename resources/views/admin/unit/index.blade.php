@extends('admin.admin_master')
@section('title','All Units')
@section('admin')

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title text-center">Unit All Data </h4>
                        </div>
                        <div class="card-body">

                            <a href="{{ route('unit.create') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;">Add Unit </a> <br>  <br>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Unit Name</th>
                                    <th>Action</th>

                                </thead>


                                <tbody>

                                @foreach($units as $key => $unit)
                                    <tr>
{{--                                        <td> {{ $key+1}} </td>--}}
                                        <td> {{ ++$key}} </td>
                                        <td> {{ $unit->name }} </td>
                                        <td>
                                            <a href="{{ route('unit.edit',$unit->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
                                            <form action="{{ route('unit.destroy',$unit->id) }}" id="form_select" method="post">
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


