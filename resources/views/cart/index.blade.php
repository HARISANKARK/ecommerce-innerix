@extends('layouts.side')
@section('content')

    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Carts</h1>
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
                                <th>Category</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$cart->c_name}}</td>
                                        <td>{{$cart->p_name}}</td>
                                        <td>{{$cart->p_price}}</td>
                                        <td>
                                            <img src="{{ asset($cart->p_image_path) }}" alt="user-avatar" class="img-circle img-fluid" width="50px" height="30px">
                                        </td>
                                        <td>
                                            @can('delete')
                                                <a href="{{route('carts.destroy',$cart->c_id)}}" class="btn" onclick="return confirm('Do you want to delete This Entry ?')"><i class="fa fa-trash"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><b>Total</b></td>
                                    <td></td>
                                    <td><b>{{$carts->sum('p_price')}}</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
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

@endsection
