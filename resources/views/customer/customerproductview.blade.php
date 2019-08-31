@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8 offset-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('customer/order') }}">Order List</a></li>
          <li class="breadcrumb-item active" aria-current="page">Product List</li>
        </ol>
      </nav>
      <div class="card">
        <div class="card-header">
          <h4>Product View</h4>
        </div>
        <div class="card-body text-center">
          <table class="table table-bordered">
            <tr>
              <th>Product Name</th>
              <th>Product Image</th>
              <th>Product Price</th>
              <th>Product Quantity</th>
              <th>Total Amount</th>
            </tr>
            @foreach ($product_orders as $product_order)
              <tr>
                <td>{{ $product_order->billToproduct->product_name }}</td>
                <td>
                  <img src="{{ asset('upload/product_images/') }}/{{ $product_order->billToproduct->product_image }}" width="60">
                 </td>
                <td>{{ $product_order->product_price }}</td>
                <td>{{ $product_order->product_quantity }}</td>
                <td>{{ $intotal_amount=($product_order->product_price*$product_order->product_quantity) }}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
