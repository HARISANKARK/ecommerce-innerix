@extends('layouts.side')

@section('content')

<div>
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Permission create</h3>
            </div>
              
            <form action="{{route('permissions.store')}}" method="post"  id="formId" >
                @csrf
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Permission Name</label>
                        <input type="text" class="form-control" name="name"  placeholder="" required>
                      </div>
                    </div>
                   
                    <div class="card-footer">
                      <button type="submit" id='submitBtn' class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>    

 
@endsection
