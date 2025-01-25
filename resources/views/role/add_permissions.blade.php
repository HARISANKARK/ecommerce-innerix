@extends('layouts.side')

@section('content')

<div>
    <div class="container-fluid">
        <div class="card card-primary">
            
            <div class="card-header">
                <h3 class="card-title">Role : {{$role->name}}</h3>
            </div>

            <form action="{{route('roles.give_permission_to_role',$role->id)}}" method="post" id="formId" >
               @csrf
               @method('put')
                <div class="card-body">
                    <div class="row">
                        <h5><b>Permissions</b></h5>
                    </div><br>
                    <div class="row">
                        @foreach ($permissions as $permission)
                          <div class="form-group col-md-3">
                            <label for="exampleInputEmail1">
                                <input
                                    type="checkbox"
                                    name="permission[]"
                                    value="{{$permission->name}}"
                                    {{in_array($permission->id, $role_permissions) ? 'checked':''}}
                                >
                                {{$permission->name}}
                            </label>
                          </div>
                        @endforeach
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
