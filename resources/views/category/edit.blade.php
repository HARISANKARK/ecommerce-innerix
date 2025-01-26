@extends('layouts.side')

@section('content')

    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Category</h3>
            </div>
            <form action="{{route('categories.update',$category->c_id)}}" method="post" id="formId">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Category</label>
                        <input type="text" class="form-control" name="name"  placeholder="Enter Category Name" value="{{$category->c_name}}" required>
                        @error('name')
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
