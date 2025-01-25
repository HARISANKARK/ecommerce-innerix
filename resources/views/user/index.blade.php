@extends('layouts.side')

@section('content')
<div>
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Users</h3>
            </div>
            <div class="card-footer">
                <a href="{{url('users/create')}}" class="btn btn-warning float-end">Add User</a>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Sl No</th>
                        <th scope="col">User name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Roles</th>
                        <th scope="col">#</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @foreach($users as $user)
                        <tr class="odd">
                            <th scope="row">{{$i++}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if (!empty($user->getRoleNames()))
                                    @foreach ($user->getRoleNames() as $role_name)
                                        <label class="badge bg-dark mx-1">{{$role_name}}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn"  onclick="return confirm('Do you want to Edit this User ?')"><i class="fa fa-pencil"></i></a>
                               
                                <a href="{{route('users.destroy',$user->id)}}" class="btn" onclick="return confirm('Do you want to delete this User ?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                      @endforeach
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
