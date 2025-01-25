@extends('layouts.side')

@section('content')

<div>
    <div class="container-fluid">
        <div class="card card-primary">
           
            <div class="card-header">
                <h3 class="card-title">User create</h3>
            </div>

            <form action="{{route('users.store')}}" method="post" id="formId" >
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" class="form-control" name="name"  placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email"  placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">password</label>
                            <input type="password" class="form-control" name="password"  placeholder="" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1">Roles</label>
                            <select name="roles[]" id="role" class="select2"  multiple="multiple" style="width: 100%">
                                <option value="" hidden></option>
                                @foreach ($roles as $role)
                                    <option value="{{$role}}">{{$role}}</option>
                                @endforeach
                            </select>
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
