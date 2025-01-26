@extends('layouts.side')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <section class="content">
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
            </section>
        </div>
    </div>
</div>
@endsection
