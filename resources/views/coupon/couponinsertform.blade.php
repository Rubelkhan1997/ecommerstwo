@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8">
        @if (session('delete') )
          <div class="alert alert-info">
            {{ session('delete') }}
          </div>
        @endif
        <div class="card">
          <div class="card-header">
            <h4>Coupon List</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <tr>
                <th>Coupon Name</th>
                <th>Discount Amount(%)</th>
                <th>Valid Till(Date)</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              @forelse ($coupon_infor as $coupon_info)
                <tr>
                  <td>{{ $coupon_info->	coupon_name }}</td>
                  <td>{{ $coupon_info->	discount_amount }}</td>
                  <td>{{ $coupon_info->	valid_till }}</td>
                  <td>
                    @if (Carbon\Carbon::now()->format('Y-m-d') <=  $coupon_info->	valid_till)
                    <div class="bg-info p-2 text-center text-white" style="border-radius:12px; box-shadow:1px 1px 4px 0px black">
                      Valid
                    </div>
                    @else
                      <div class="bg-danger p-2 text-center text-white" style="border-radius:12px; box-shadow:1px 1px 4px 0px black">
                        Invalid
                      </div>
                    @endif
                  </td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ url('coupan/item/delete') }}/{{ $coupon_info-> id }}" class="btn btn-danger">Delete</a>
                    </div>
                  </td>
                </tr>
                @empty
                  <tr class="text-center text-danger">
                    <td colspan="4"><h5>Not Coupon Is Here</h5></td>
                  </tr>
              @endforelse
            </table>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
          @if (session('status') )
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-header">
            <h4>Add Coupon Form</h4>
          </div>
          <div class="card-body">
              @if ($errors->all())
                  <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                      <li> {{ $error }}</li>
                    @endforeach
                  </div>
                @endif
            <form action="{{ url('coupon/insert/form/post') }}" method="post">
              @csrf
              <div class="form-group">
                <label>Coupon Name</label>
                <input type="text" class="form-control" name="coupon_name" placeholder="Enter your coupon name" value="{{ old('coupon_name') }}">
              </div>
              <div class="form-group">
                <label>Discount Amount(%)</label>
                <input type="text" class="form-control" name="discount_amount" placeholder="Enter your discount amount" value="{{ old('discount_amount') }}">
              </div>
              <div class="form-group">
                <label>Valid Till(Date)</label>
                <input type="date" class="form-control" name="valid_till">
              </div>
              <button type="submit" class="btn btn-success">Add Coupon</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
