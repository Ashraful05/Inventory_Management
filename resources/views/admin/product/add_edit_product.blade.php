@extends('admin.admin_master')
@if($product->exists)
    @section('title','Edit Product')
@else
    @section('title','Add Product')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('product.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Product </a>
                            @if($product->exists)
                                <h4 class="card-title text-center">Edit Product Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Category Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($product->exists)
                                <form action="{{ route('product.update',$product->id) }}" method="post" id="myForm">
                                    @method('put')
                                    @else
                                        <form action="{{ route('product.store') }}" method="post" id="myForm">
                                            @endif
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Name </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="name" value="{{ old('name',$product->name) }}" class="form-control" type="text">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">Supplier Name </label>
                                                <div class="form-group col-sm-10">
                                                    <select name="supplier_id" class="form-select" aria-label="Default select example">
                                                        <option value="0" {{ $product->exists? '' : 'selected' }}>Select Supplier Name</option>
                                                        @foreach($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}" @if($supplier->id == $product->supplier_id) selected @endif>
                                                                {{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-2 col-form-label">Category Name</label>
                                                <div class="form-group col-sm-10">
                                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                                        <option value="0" {{ $product->exists?'' : 'selected' }}>Select Category Name</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" @if($category->id == $product->category_id)selected @endif>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="" class="col-sm-2 col-form-label">Unit Name</label>
                                                <div class="form-group col-sm-10">
                                                    <select name="unit_id" class="form-select" aria-label="Default select example" id="">
                                                        <option value="0" {{ $product->exists?'':'selected' }}>Select Unit Name</option>
                                                        @foreach($units as $unit)
                                                            <option value="{{ $unit->id }}" @if($unit->id == $product->unit_id)selected @endif>{{ $unit->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Product Quantity </label>
                                                <div class="form-group col-sm-10">
                                                    <input name="quantity" value="{{ old('quantity',$product->quantity) }}" class="form-control" type="number">
                                                    @error('quantity')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            @if($product->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Product</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Product</button>
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
                    supplier_id: {
                        required : true,
                    },
                    category_id: {
                        required : true,
                    },
                    unit_id: {
                        required : true,
                    },
                    quantity:{
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required : 'Please Enter Product Name',
                    },
                    supplier_id: {
                        required : 'Please Choose One Supplier',
                    },
                    category_id: {
                        required : 'Please Choose One Category',
                    },
                    unit_id: {
                        required: "please choose unit type",
                    },
                    quantity: {
                        required: 'Please enter product quantity'
                    }
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

