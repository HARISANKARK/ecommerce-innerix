@extends('layouts.side')
@section('content')

    <div class="container-fluid">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Categories</h1>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Sl No</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1) @foreach($categories as $category)

                                <tr class="odd">
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{$category->c_name}}</td>
                                    <td>
                                        @can('edit')
                                            <a href="{{route('categories.edit',$category->c_id)}}" class="btn"><i class="fa fa-pencil"></i></a>
                                        @endcan
                                        @can('delete')
                                            <a href="{{route('categories.destroy',$category->c_id)}}" class="btn" onclick="return confirm('Do you want to delete This Entry ?')"><i class="fa fa-trash"></i></a>
                                        @endcan
                                    </td>
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
    </div>

@endsection
