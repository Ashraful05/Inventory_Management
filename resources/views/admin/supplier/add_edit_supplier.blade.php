@extends('admin.admin_master')
@if($supplier->exists)
    @section('title','Edit Supplier')
@else
    @section('title','Add Supplier')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('supplier.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Supplier </a>
                            @if($supplier->exists)
                                <h4 class="card-title text-center">Edit Supplier Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Supplier Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($supplier->exists)
                                <form action="{{ route('supplier.update',$supplier->id) }}" method="post" id="myForm">
                                    @method('put')
                                    @else
                                        <form action="{{ route('supplier.store') }}" method="post" id="myForm">
                                            @endif
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Name </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="name" value="{{ old('name',$supplier->name) }}" class="form-control" type="text">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Mobile </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="mobile_no" value="{{ old('mobile_no',$supplier->mobile_no) }}" class="form-control" type="text">
                                                    @error('mobile_no')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Email </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="email" value="{{ old('email',$supplier->email) }}" class="form-control" type="email">

                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Supplier Address </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="address" value="{{ old('address',$supplier->address) }}" class="form-control" type="text">


                                                </div>
                                            </div>
                                            <!-- end row -->
                                            @if($supplier->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Supplier</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Supplier</button>
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
                    mobile_no: {
                        required : true,
                    },
                    email: {
                        required : true,
                    },
                    address: {
                        required : true,
                    },
                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
                    },
                    mobile_no: {
                        required : 'Please Enter Your Mobile Number',
                    },
                    email: {
                        required : 'Please Enter Your Email',
                    },
                    address: {
                        required : 'Please Enter Your Address',
                    },
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
