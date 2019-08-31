@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-6">
      <div class="card">
        <div class="card-header">
          <h4>Total Order</h4>
        </div>
        <div class="card-body text-center">
          <h4> {{ $products }} {{ ($products <= 1)? 'Order': str_plural('Order') }}</h4>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
