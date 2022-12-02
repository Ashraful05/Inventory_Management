@extends('admin.admin_master')
@if($customer->exists)
    @section('title','Edit Customer')
@else
    @section('title','Add Customer')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('customer.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Customer </a>
                            @if($customer->exists)
                                <h4 class="card-title text-center">Edit Customer Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Customer Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($customer->exists)
                                <form action="{{ route('customer.update',$customer->id) }}" method="post" id="myForm" enctype="multipart/form-data">
                                    <input type="hidden" name="old_image" value="{{ $customer->customer_image }}">
                                    @method('put')
                                    @else
                                        <form action="{{ route('customer.store') }}" method="post" id="myForm" enctype="multipart/form-data">
                                            @endif
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Name </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="name" value="{{ old('name',$customer->name) }}" class="form-control" type="text">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Mobile </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="mobile_no" value="{{ old('mobile_no',$customer->mobile_no) }}" class="form-control" type="text">
                                                    @error('mobile_no')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Email </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="email" value="{{ old('email',$customer->email) }}" class="form-control" type="email">

                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Address </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="address" value="{{ old('address',$customer->address) }}" class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Customer Image </label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="customer_image" class="form-control" id="image">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">  </label>
                                                <div class="col-sm-10">
                                                    <img id="showImage" class="rounded avatar-lg" src="{{ (!empty($customer->customer_image))?asset($customer->customer_image):url('upload/no_image.jpg') }}" alt="Card image cap">
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            @if($customer->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Customer</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Customer</button>
                                            @endif

                                        </form>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    // name: {
                    //     required : true,
                    // },
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
                        required : 'Please Enter Your Name',
                    },
                    mobile_no: {
                        required : 'Please Enter Your Mobile Number',
                    },
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
