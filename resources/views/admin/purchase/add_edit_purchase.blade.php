@extends('admin.admin_master')
@if($purchase->exists)
    @section('title','Edit Purchase')
@else
    @section('title','Add Purchase')
@endif
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('purchase.index') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Purchase Info </a>
                            @if($purchase->exists)
                                <h4 class="card-title text-center">Edit Purchase Data</h4>
                            @else
                                <h4 class="card-title text-center">Add Purchase Data</h4>
                            @endif
                        </div>
                        <div class="card-body">

                            @if($purchase->exists)
                                <form action="{{ route('purchase.update',$purchase->id) }}" method="post" id="myForm">
                                    @method('put')
                                    @else
                                        <form action="{{ route('purchase.store') }}" method="post" id="myForm">
                                            @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Date</label>
                                                        <input class="form-control example-date-input" name="date"
                                                               value="{{ old('date',$purchase->date) }}" type="date"  id="date">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Purchase No</label>
                                                        <input class="form-control example-date-input" name="purchase_no"
                                                               value="{{ old('purchase_no',$purchase->purchase_no) }}" type="text" id="purchase_no">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Supplier Name </label>
                                                        <select id="supplier_id" name="supplier_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Select Supplier</option>
                                                            @foreach($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Category Name </label>
                                                        <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Select Category</option>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Product Name </label>
                                                        <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                            <option selected="">Select Product</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                                        <i class="addeventmore btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle"> Add More</i>
                                                    </div>
                                                </div>
                                            </div> <!-- // end row  -->
                                            <table class="table-sm table-bordered mb-3" width="100%" style="border-color: #ddd;">
                                                <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Product Name</th>
                                                    <th>PSC/KG</th>
                                                    <th>Unit Price</th>
                                                    <th>Description</th>
                                                    <th>Total Price</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="addRow" class="addRow">
                                                <tr>
                                                    <td colspan="5"></td>
                                                    <td>
                                                        <input type="text" name="estimated_amount" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                                    </td>
                                                    <td></td>
                                                </tr>
                                                </tbody>

                                            </table>
                                            <div class="form-group">
                                                @if($purchase->exists)
                                                    <button type="submit" class="btn btn-info" id="updateButton">Purchase Update</button>
                                                @else
                                                    <button type="submit" class="btn btn-info" id="storeButton">Purchase Store</button>
                                                @endif
                                            </div>

                                        </form>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/x-handlebars-template" id="document-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{ date }}">
            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control buying_quantity text-right" name="buying_quantity[]" value="">
            </td>
            <td>
                <input type="number" min="1" class="form-control unit_price text-right" name="unit_price[]" value="">
            </td>
            <td>
                <input type="text" class="form-control" name="description[]">
            </td>
            <td>
                <input type="number" class="form-control buying_price text-right" name="buying_price" value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
            </td>
        </tr>
    </script>

    <script>
        $(document).ready(function(){
            $(document).on('click','.addeventmore',function(){
                var date = $("#date").val();
                var purchase_no = $("#purchase_no").val();
                var supplier_id = $("#supplier_id").val();
                var supplier_name = $("#supplier_id").find('option:selected').text();
                var category_id = $("#category_id").val();
                var category_name = $("#category_id").find('option:selected').text();
                var product_id = $("#product_id").val();
                var product_name = $("#product_id").find('option:selected').text();

                if(date == ''){
                    $.notify("Date is required",{globalPosition:'top-right', className:'error'});
                    return false;
                }
                if(purchase_no == ''){
                    $.notify("Purchase No. is required",{globalPosition:'top-right',className: 'error'});
                    return false;
                }
                if(supplier_id == ''){
                    $.notify("Supplier is required",{globalPosition:'top-right',className:'error'});
                    return false;
                }
                if(category_id == ''){
                    $.notify("Category is required",{globalPosition:'top-right',className:'error'});
                    return false;
                }
                if(product_id == ''){
                    $.notify("Product is required",{globalPosition:'top-right',className:'error'});
                    return false;
                }

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date:date,
                    purchase_no:purchase_no,
                    supplier_id:supplier_id,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name
                };
                var html = template(data);
                $("#addRow").append(html);
            });
            $(document).on('click','.removeeventmore',function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });
            $(document).on('keyup click','.unit_price,.buying_quantity',function(){
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.buying_quantity').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('input.buying_price').val(total);
                totalAmountPrice();
            });

            // calculate sum of amount in invoice......
            function totalAmountPrice()
            {
                var sum = 0;
                $('.buying_price').each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }
        });
    </script>



    <script>
        $(function(){
            $(document).on('change','#supplier_id',function(){
                var supplier_id = $(this).val();
                // alert(supplier_id);
                $.ajax({
                    url: "{{ route('get_category') }}",
                    type:'get',
                    data:{supplier_id:supplier_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,value){
                            html += '<option value=" '+value.category_id+' ">'+value.category.name+'</option>';
                        });
                        $("#category_id").html(html);
                    }
                });
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

