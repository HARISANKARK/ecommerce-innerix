@extends('layouts.side')

@section('content')
<div>
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Roles</h3>
            </div>

            <div class="card-footer">
                <a href="{{url('roles/create')}}" class="btn btn-warning float-end">Add Role</a>
            </div>
            
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sl No</th>
                            <th scope="col">Role</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @foreach($roles as $x)
                        <tr class="odd">
                            <th scope="row">{{$i++}}</th>
                            <td>{{$x->name}}</td>
                            <td>
                                <!--<a href="{{route('roles.edit',$x->id)}}" class="btn" onclick="return confirm('Do you want to Edit this Role ?')"><i class="fa fa-pencil"></i></a>-->
                            
                                 <a href="{{route('roles.add_permission_to_role',$x->id)}}" class="btn btn-info" role="button">Add/Edit Role Permission</a>
                           
                                 <!--<a href="{{route('roles.destroy',$x->id)}}" class="btn" onclick="return confirm('Do you want to delete this Role ?')"><i class="fa fa-trash"></i></a>-->
                            </td>
                        </tr>
                      @endforeach
                    </tfoot>
                </table>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>


@endsection
