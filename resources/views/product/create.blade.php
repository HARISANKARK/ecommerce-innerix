@extends('layouts.side')

@section('content')

    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Add Product</h3>
            </div>
            <form action="{{route('products.store')}}" method="post" id="formId" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name"  placeholder="Enter Product Name" required>
                        @error('name')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Category</label>
                        <select class="form-control select2bs4" name="category_id" id="category_id" required>
                            <option value="" hidden></option>
                            @foreach($categories as $category)
                            <option value="{{$category->c_id}}">{{$category->c_name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" class="form-control" name="qty"  placeholder="Enter Product Quantity" required>
                        @error('qty')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Previous Price</label>
                        <input type="number" step="any" class="form-control" name="previous_price"  placeholder="Enter Product Previous Price" required>
                        @error('previous_rate')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" step="any" class="form-control" name="price"  placeholder="Enter Product Current Price" required>
                        @error('price')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Discount %</label>
                        <input type="number" step="any" class="form-control" name="discount_per"  placeholder="Enter Product Discount %" required>
                        @error('discount_per')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="image" accept="image/*" required>
                        @error('image')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea class="form-control" placeholder="Enter Product Description" name="description" id="description" style="height: 100px" required></textarea>
                        @error('description')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" id='submitBtn' class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection
