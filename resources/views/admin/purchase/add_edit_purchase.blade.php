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
                                                        <input class="form-control example-date-input" name="date" value="{{ old('date',$purchase->date) }}" type="date"  id="date">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Purchase No</label>
                                                        <input class="form-control example-date-input" name="purchase_no" value="{{ old('purchase_no',$purchase->purchase_no) }}" type="text"  id="purchase_no">
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Supplier Name </label>
                                                        <select id="supplier_id" name="supplier_id" class="form-select" aria-label="Default select example">
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
                                                        <select name="category_id" id="category_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Select Category</option>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label">Product Name </label>
                                                        <select name="product_id" id="product_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Select Product</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <div class="md-3">
                                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                                        <input type="submit" class="btn btn-secondary btn-rounded waves-effect waves-light" value="Add More">
                                                    </div>
                                                </div>
                                            </div> <!-- // end row  -->
                                            @if($purchase->exists)
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Update Purchase</button>
                                            @else
                                                <button type="submit" class="btn btn-info waves-effect waves-light form-control">Add Purchase</button>
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

