@extends('admin.admin_master')
@section('title','Supplier / Product Wise Stock Report')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-sm-0 text-center">Supplier /  Product Wise Stock Report</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <strong>Supplier Wise Report</strong>
                                    <input type="radio" class="search_value" name="supplier_product_wise"
                                           value="supplier_wise">&nbsp;

                                    <strong>Product Wise Report</strong>
                                    <input type="radio" class="search_value" name="supplier_product_wise"
                                           value="product_wise">
                                </div>
                            </div>
                            <div class="show_supplier" style="display: none;">
                                <form action="{{ route('supplier_wise_pdf_report') }}" method="get"
                                      id="myForm" target="_blank">
                                    <div class="row">
                                        <div class="col-sm-8 form-group">
                                            <label for="">Supplier Name</label>
                                            <select name="supplier_id" class="form-select select2">
                                                <option value="" selected disabled>Open this select menu</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-sm-4" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="show_product mt-3" style="display:none;">
                                <form action="{{ route('product_wise_pdf_report') }}" method="get"
                                      id="myForm" target="_blank">
                                    <div class="row">
                                        <div class="col-sm-5 form-group">
                                                <label for="example-text-input" class="form-label">Category Name </label>
                                                <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="" disabled>Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="col-sm-5 form-group">
                                                <label for="example-text-input" class="form-label">Product Name </label>
                                                <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                    <option selected="" disabled>Select Product</option>
                                                </select>
                                        </div>
                                        <div class="col-sm-2" style="padding-top: 30px;">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>




                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>

    <script>
        $(document).on('change','.search_value',function () {
            var search_value = $(this).val();
            if(search_value == 'supplier_wise'){
                $('.show_supplier').show();
            }else{
                $('.show_supplier').hide();
            }
        });
    </script>

    <script>
        $(document).on('change','.search_value',function(){
           var search_value = $(this).val();
           if(search_value == 'product_wise'){
               $('.show_product').show();
           }else{
               $('.show_product').hide();
           }
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    supplier_id: {
                        required : true,
                    },
                    category_id:{
                        required:true,
                    },
                    product_id:{
                        required:true,
                    }
                },
                messages :{
                    supplier_id: {
                        required : 'Please Select Supplier ',
                    },
                    category_id: {
                        required : 'Please Select Category ',
                    },
                    product_id: {
                        required : 'Please Select Product ',
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

    <script>
        $(function () {
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{ route('get_product') }}",
                    type:'get',
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function(key,value){
                            html += '<option value=" '+value.id+' ">'+value.name+'</option>';
                        });
                        $("#product_id").html(html);
                    }
                });
            });
        });
    </script>

@endsection

