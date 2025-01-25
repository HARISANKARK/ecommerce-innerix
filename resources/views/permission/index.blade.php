@extends('layouts.side')

@section('content')
<div>
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Permissions</h3>
            </div>
            <div class="card-footer">
                <a href="{{url('permissions/create')}}" class="btn btn-warning float-end" >Add Permission</a>
            </div>
           
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th scope="col-1" style="width:20%">Sl No</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                      @php($i=1)
                      @foreach($permissions as $x)
                        <tr class="odd">
                            <th scope="row">{{$i++}}</th>
                            <td>{{$x->name}}</td>
                            <td>
                                 <a href="{{route('permissions.edit',$x->id)}}" class="btn" onclick="return confirm('Do you want to delete this Permission ?')"><i class="fa fa-pencil" ></i></a>
                                 <!--<a href="{{route('permissions.destroy',$x->id)}}" class="btn" onclick="return confirm('Do you want to delete this Permission ?')"><i class="fa fa-trash"></i></a>-->
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
