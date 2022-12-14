@extends('admin.admin_master')
@section('title','Add Invoice')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('invoice_all') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float: right;">All Invoice Info </a>
                            <h4 class="card-title text-center">Add Invoice Data</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('invoice_save') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Invoice No. Id</label>
                                            <input class="form-control example-date-input" name="invoice_no_id" value="{{ $invoiceNo }}"
                                                   type="text" id="invoice_no" readonly style="background-color: #ddd;">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Date</label>
                                            <input class="form-control example-date-input" name="date"
                                                   value="{{ $date }}" type="date"  id="date">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Category Name </label>
                                            <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                                <option selected="" disabled>Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Product Name </label>
                                            <select name="product_id" id="product_id" class="form-select select2" aria-label="Default select example">
                                                <option selected="" disabled>Select Product</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="md-3">
                                            <label for="example-text-input" class="form-label">Stock(Pic/Kg)</label>
                                            <input class="form-control example-date-input" name="current_stock_qty" type="text"  id="current_stock_qty" readonly style="background-color:#ddd" >
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
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
                                        <th>Total Price</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow">
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <td colspan="4">Discount Amount</td>
                                        <td>
                                            <input type="text" name="discount_amount" value="{{ old('discount_amount') }}" id="discount_amount" class="form-control discount_amount" placeholder="Discount Amount">
                                        </td>
                                    </tr>
                                        <tr>
                                            <td colspan="4">Grand Total</td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="{{ old('estimated_amount') }}" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>

                                </table>
                                <div class="form-row mb-3">
                                    <div class="form-group col-md-12">
                                        <textarea class="form-control" name="description" id="description" placeholder="Write description here...."></textarea>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="form-group col-md-3">
                                        <label>Paid Status</label>
                                        <select name="paid_status" id="paid_status" class="form-select">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="full_paid">Full Paid</option>
                                            <option value="full_due">Full Due</option>
                                            <option value="partial_paid">Partial Paid</option>
                                        </select>
                                        <input type="text" name="paid_amount"  id="paid_amount" class="form-control mt-2 paid_amount"
                                               placeholder="Enter Partial Amount" style="display: none;">
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="">Customer Name</label>
                                        <select name="customer_id" id="customer_id" class="form-select">
                                            <option value="" selected disabled>Select Customer</option>
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}:  {{ $customer->mobile_no }}</option>
                                            @endforeach
                                            <option value="0">New Customer</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row new_customer mb-2" style="display: none;">
                                    <div class="form-group col-md-4">
                                        <label for="">Customer Name</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Write customer name...">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Customer Mobile No.</label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">Customer Email</label>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Write customer email...">
                                    </div>
                                </div>

                                <div class="form-group">
                                        <button type="submit" class="btn btn-info" id="storeButton">Invoice Store</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/x-handlebars-template" id="document-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date" value="@{{ date }}">
            <input type="text" name="invoice_no_id" value="@{{ invoice_no_id }}">
            <td>
                <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_name }}
            </td>
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control selling_quantity text-right" name="selling_quantity[]" value="">
            </td>
            <td>
                <input type="number" min="1" class="form-control unit_price text-right" name="unit_price[]" step="0.01">
            </td>
            <td>
                <input type="number" class="form-control selling_price text-right" name="selling_price" value="0" readonly>
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
                var invoice_no = $("#invoice_no").val();
                // var supplier_id = $("#supplier_id").val();
                // var supplier_name = $("#supplier_id").find('option:selected').text();
                var category_id = $("#category_id").val();
                var category_name = $("#category_id").find('option:selected').text();
                var product_id = $("#product_id").val();
                var product_name = $("#product_id").find('option:selected').text();

                if(date == ''){
                    $.notify("Date is required",{globalPosition:'top-right', className:'error'});
                    return false;
                }
                if(invoice_no == ''){
                    $.notify("Invoice No. is required",{globalPosition:'top-right',className: 'error'});
                    return false;
                }
                // if(supplier_id == ''){
                //     $.notify("Supplier is required",{globalPosition:'top-right',className:'error'});
                //     return false;
                // }
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
                    invoice_no:invoice_no,
                    // supplier_id:supplier_id,
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
            $(document).on('keyup click','.unit_price,.selling_quantity',function(){
                var unit_price = $(this).closest('tr').find('input.unit_price').val();
                var qty = $(this).closest('tr').find('input.selling_quantity').val();
                var total = unit_price * qty;
                $(this).closest('tr').find('input.selling_price').val(total);
                $("#discount_amount").trigger('keyup');
                // totalAmountPrice();
            });

            $(document).on('keyup','#discount_amount',function (){
               totalAmountPrice();
            });

            // calculate sum of amount in invoice......
            function totalAmountPrice()
            {
                var sum = 0;
                $('.selling_price').each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length !== 0){
                        sum += parseFloat(value);
                    }
                });
                var discountAmount = parseFloat($("#discount_amount").val());
                if(!isNaN(discountAmount) && discountAmount.length !== 0){
                    sum -= parseFloat(discountAmount);
                }
                $('#estimated_amount').val(sum);
            }
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
    <script>
        $(function () {
            $(document).on('change','#product_id',function(){
                var product_id = $(this).val();
                $.ajax({
                    url:"{{ route('check_product_stock') }}",
                    type:'get',
                    data:{product_id:product_id},
                    success:function(data){
                        $("#current_stock_qty").val(data);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).on('change','#paid_status',function(){
             var paidStatus = $(this).val();
             if(paidStatus == 'partial_paid'){
                 $("#paid_amount").show();
             }else{
                 $("#paid_amount").hide();
             }
        });
    </script>

    <script>
        $(document).on('change','#customer_id',function (){
            var customerId = $(this).val();
            if(customerId === '0'){
                $('.new_customer').show();
            }else{
                $('.new_customer').hide();
            }
        });
    </script>


@endsection


