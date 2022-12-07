@extends('admin.admin_master')
@if($category->exists)
    @section('title','Edit Category')
@else
    @section('title','Add Category')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('category.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Category </a>
                            @if($category->exists)
                                <h4 class="card-title text-center">Edit Category Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Category Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($category->exists)
                                <form action="{{ route('category.update',$category->id) }}" method="post" id="myForm">
                                    @method('put')
                                    @else
                                        <form action="{{ route('category.store') }}" method="post" id="myForm">
                                            @endif
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Category Name </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="name" value="{{ old('name',$category->name) }}" class="form-control" type="text">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            @if($category->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Category</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Category</button>
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
                        required : 'Please Enter Category Name',
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

