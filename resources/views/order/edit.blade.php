@extends('layouts.side')

@section('content')

    <div class="container-fluid">
        <!-- Display Product Details -->
        <div class="card card-info mb-3">
            <div class="card-header">
                <h3 class="card-title">Product Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{ asset($order->p_image_path) }}" alt="{{ $order->p_name }}" class="img-fluid rounded">
                    </div>
                    <div class="col-md-9">
                        <h4>{{ $order->p_name }}</h4>
                        <p><strong>Category:</strong> {{ $order->c_name }}</p>
                        <p><strong>Price:</strong> ${{ number_format($order->p_price, 2) }}</p>
                        <p><strong>Discount:</strong> {{ $order->p_discount_per }}%</p>
                        <p><strong>Description:</strong> {{ $order->p_description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Order</h3>
            </div>
            <form action="{{route('orders.update',$order->o_id)}}" method="post" id="formId" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="date" class="form-control" name="date"  value="{{$order->date}}" required>
                        @error('date')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$order->name}}" placeholder="Enter Name" required>
                        @error('name')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Address</label>
                        <input type="text" class="form-control" name="address" value="{{$order->address}}" placeholder="Enter Address" required>
                        @error('address')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Contact No</label>
                        <input type="tel" class="form-control" name="contact_no" value="{{$order->contact_no}}"  placeholder="Enter 10-digit number" pattern="[0-9]{10}" required>
                        @error('contact_no')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lan Mark</label>
                        <input type="text" class="form-control" name="lan_mark" value="{{$order->lan_mark}}"  placeholder="Enter Lan Mark" required>
                        @error('lan_mark')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Quantity</label>
                        <input type="number" class="form-control" name="qty" id="qty" value="{{$order->qty}}"  max="{{$balance_qty}}" oninvalid="this.setCustomValidity('Stock Quantity Exceeded {{$balance_qty}}')" oninput="this.setCustomValidity(''),calcAmt()"  placeholder="Enter Product Quantity" required>
                        @error('qty')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Price</label>
                        <input type="number" step="any" class="form-control" name="price" id="price" value="{{$order->price}}"  placeholder="Enter Product Price" oninput="calcAmt()" required>
                        @error('price')
                            <span style="color: red;">{{ $message }}</span><br>
                        @enderror
                      </div>
                      <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Amount</label>
                        <input type="number" step="any" class="form-control" name="amount" value="{{$order->amount}}" id="amount" placeholder="Enter Total Amount" required>
                        @error('amount')
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

<script>
    function calcAmt()
    {
        var qty = parseFloat($('#qty').val());
        var price = parseFloat($('#price').val());
        var amt = 0;
        if(qty && price){
            amt = (qty * price).toFixed(2);
        }
        $('#amount').val(amt);
    }
</script>

@endsection
