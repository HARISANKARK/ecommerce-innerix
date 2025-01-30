@extends('layouts.side')
@section('content')

    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Products</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select  class="form-control select2bs4" name="category_id">
                                            <option value="" hidden></option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2" style="padding-top:31px">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Previous Price</th>
                                <th>Price</th>
                                <th>Discount %</th>
                                <th>Image</th>
                                <th>Description</th>
                                <th>#</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$product->p_name}}</td>
                                        <td>{{$product->c_name}}</td>
                                        <td>{{$product->p_qty}}</td>
                                        <td>{{$product->p_previous_price}}</td>
                                        <td>{{$product->p_price}}</td>
                                        <td>{{$product->p_discount_per}}</td>
                                        <td>
                                            <img src="{{ asset($product->p_image_path) }}" alt="user-avatar" class="img-circle img-fluid" width="50px" height="30px">
                                        </td>
                                        <td>{{$product->p_description}}</td>
                                        <td>
                                            @can('carts')
                                                <a href="{{route('carts.store',$product->p_id)}}" class="btn btn-sm bg-teal">
                                                    <i class="fas fa-cart-plus"></i>
                                                </a>
                                            @endcan
                                            <a href="{{route('orders.create',$product->p_id)}}" id="{{$product->p_id}}" class="btn btn-sm btn-primary">
                                                BuyNow
                                            </a>
                                            <a href="#" class="btn" id="{{$product->p_id}}out" style="display: none;color:red">
                                                Out Of Stock
                                            </a>
                                        </td>
                                        <td>
                                            @can('edit')
                                                <a href="{{route('products.edit',$product->p_id)}}" class="btn"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('delete')
                                                <a href="{{route('products.destroy',$product->p_id)}}" class="btn" onclick="return confirm('Do you want to delete This Entry ?')"><i class="fa fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- Custom Js --}}
<script src="{{asset('js/custom/display_product_stock.js')}}"></script>
<script>
    $(document).ready(function() {
        console.log('ready');
        calcProductStock();
    });
</script>

@endsection
