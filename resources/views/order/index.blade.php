@extends('layouts.side')
@section('content')

    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Orders</h1>
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
                                        <label for="exampleInputEmail1">From</label>
                                        <input type="date" class="form-control" name="from"  value="{{date('Y-m-d')}}" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">To</label>
                                        <input type="date" class="form-control" name="to"  value="{{date('Y-m-d')}}" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select  class="form-control select2bs4" name="category_id" id="category_id" onchange="getProducts()">
                                            <option value="" hidden></option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exampleInputEmail1">Product</label>
                                        <select  class="form-control select2bs4" name="product_id" id="product_id">
                                            <option value="" hidden></option>
                                            @foreach($products as $product)
                                                <option value="{{$product->p_id}}">{{$product->p_name}}</option>
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
                            <caption style="caption-side:top"><b>Details from the period of {{formatDate($from)}} to {{ formatDate($to)}}</b></caption>
                            <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Date</th>
                                <th>Order Id</th>
                                <th>Status</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact No</th>
                                <th>Lan Mark</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Amount</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{formatDate($order->date)}}</td>
                                        <td>{{$order->order_id}}</td>
                                        @if($order->o_status == 1)
                                            <td style="color: indigo">Order Requested</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{$order->p_name}}</td>
                                        <td>{{$order->c_name}}</td>
                                        <td>
                                            <img src="{{ asset($order->p_image_path) }}" alt="user-avatar" class="img-circle img-fluid" width="50px" height="30px">
                                        </td>
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->contact_no}}</td>
                                        <td>{{$order->lan_mark}}</td>
                                        <td>{{$order->qty}}</td>
                                        <td>{{$order->price}}</td>
                                        <td>{{$order->amount}}</td>
                                        <td>
                                            @can('edit')
                                                <a href="{{route('orders.edit',$order->o_id)}}" class="btn"><i class="fa fa-pencil"></i></a>
                                            @endcan
                                            @can('delete')
                                                <a href="{{route('orders.destroy',$order->o_id)}}" class="btn" onclick="return confirm('Do you want to delete This Entry ?')"><i class="fa fa-trash"></i></a>
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
<script src="{{asset('js/custom/display_products.js')}}"></script>
@endsection
