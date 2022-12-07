@extends('admin.admin_master')
@if($unit->exists)
    @section('title','Edit Unit')
@else
    @section('title','Add Unit')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('unit.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Unit </a>
                            @if($unit->exists)
                                <h4 class="card-title text-center">Edit Unit Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Unit Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($unit->exists)
                                <form action="{{ route('unit.update',$unit->id) }}" method="post" id="myForm">
                                    @method('put')
                                    @else
                                        <form action="{{ route('unit.store') }}" method="post" id="myForm">
                                            @endif
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Unit Name </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="name" value="{{ old('name',$unit->name) }}" class="form-control" type="text">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            @if($unit->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Unit</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Unit</button>
                                            @endif

                                        </form>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },
                    // mobile_no: {
                    //     required : true,
                    // },
                    // email: {
                    //     required : true,
                    // },
                    // address: {
                    //     required : true,
                    // },
                },
                messages :{
                    name: {
                        required : 'Please Enter Unit Name',
                    },
                    // mobile_no: {
                    //     required : 'Please Enter Your Mobile Number',
                    // },
                    // email: {
                    //     required : 'Please Enter Your Email',
                    // },
                    // address: {
                    //     required : 'Please Enter Your Address',
                    // },
                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>
@endsection
