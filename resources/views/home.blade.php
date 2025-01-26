@extends('layouts.side')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{-- <section class="content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                              <th>Sl No</th>
                              <th>Name</th>
                              <th>Description</th>
                              <th>Amount</th>
                              <th>Image</th>
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
                                        <td>{{$product->p_description}}</td>
                                        <td>{{$product->p_rate}}</td>
                                        <td>{{$product->p_image}}</td>
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
                  <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section> --}}
            <!-- Main content -->
            <section class="content">
                <!-- Default box -->
                <div class="card card-solid">
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
                    <div class="card-body pb-0">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                        {{$product->c_name}}
                                    </div>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{$product->p_name}}</b></h2>
                                            <p class="text-muted text-sm">{{$product->p_description}}</p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"><h6><span style="color: green"><i class="fas fa-arrow-down"></i>{{$product->p_discount_per}}<i class="fas fa-percentage"></i></span></h6></li>
                                                <li class="small"><h5><s>{{$product->p_previous_price}}</s><i class="fas fa-indian-rupee-sign"></i>{{$product->p_price}}</h5></li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center">
                                            <img src="{{ asset($product->p_image_path) }}" alt="user-avatar" class="img-fluid">
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                        <a href="#" class="btn btn-sm bg-teal">
                                            <i class="fas fa-cart-plus"></i>
                                        </a>
                                        <a href="{{route('orders.create',$product->p_id)}}" class="btn btn-sm btn-primary">
                                            Buy Now
                                        </a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </section>
            <!-- /.content -->
        </div>
    </div>
</div>
@endsection
