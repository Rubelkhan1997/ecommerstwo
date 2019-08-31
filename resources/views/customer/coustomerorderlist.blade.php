@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-10 offset-1">
      <div class="card">
        <div class="card-header">
          <h4>Order List</h4>
        </div>
        <div class="card-body text-center">
          <table class="table table-bordered">
            <tr>
              <th>Shipping Info</th>
              <th>Total Amount</th>
              <th>Payment Type</th>
              <th>Payment Status</th>
              <th>Purchase Ago</th>
              <th>Purchase At</th>
              <th>Action</th>
            </tr>
            @foreach ($all_orders as $all_order)
              <tr>
                <td>{{ $all_order-> shipping_id }}</td>
                <td>{{ $all_order-> total_amount }}</td>
                <td>{{ ($all_order->saleToshipping->payment_type == 1)? 'Cash On Delivary':'Credit Card' }}</td>
                <td>{{ ($all_order->saleToshipping->payment_status == 1)? 'No Yet':'Payment Successfully' }}</td>
                <td>{{ $all_order->created_at->diffForHumans() }}</td>
                <td>{{ $all_order->created_at->format('d-m-Y') }}</td>
                <td>
                  <a href="{{ url('customer/product/view') }}/{{ $all_order-> shipping_id }}" class="btn btn-success">View Details</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
