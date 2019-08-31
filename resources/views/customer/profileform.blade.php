@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-5 offset-3">
      @if (session('add') )
        <div class="alert alert-success">
          {{ session('add') }}
        </div>
      @endif
      @if (session('update') )
        <div class="alert alert-success">
          {{ session('update') }}
        </div>
      @endif
      <div class="card">
        @if (App\Customerprofile::where('user_id', Auth::id())->exists())
          @php
            $single_info = App\Customerprofile::where('user_id', Auth::id())->first();
          @endphp
        <div class="card-header">
          <h4>Update Information Form</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('customer/profile/form/update/post') }}" method="post">
              @csrf
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="first_name" value="{{ $single_info->first_name }}" >
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="last_name" value="{{ $single_info->last_name }}">
                </div>
                <div class="form-group">
                  <label>Adderss</label>
                  <input type="text" class="form-control" name="address" value="{{ $single_info->address }}">
                </div>
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="text" class="form-control" name="phone_number" value="{{ $single_info->phone_number }}">
                </div>
                <div class="form-group">
                  <label>Zip Code</label>
                  <input type="text" class="form-control" name="zip_code" value="{{ $single_info->zip_code }}">
                </div>
                <button type="submit" class="btn btn-success">Update Information</button>
           </form>
            @else
            <div class="card-header">
              <h4>Add Information Form</h4>
            </div>
            <div class="card-body">
              <form action="{{ url('customer/profile/form/post') }}" method="post">
                @csrf
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first_name" placeholder="Enter your first name" >
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Enter your last name">
                  </div>
                  <div class="form-group">
                    <label>Adderss</label>
                    <input type="text" class="form-control" name="address" placeholder="Enter your address">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" placeholder="Enter your phone number">
                  </div>
                  <div class="form-group">
                    <label>Zip Code</label>
                    <input type="text" class="form-control" name="zip_code" placeholder="Enter your zip code">
                  </div>
                  <button type="submit" class="btn btn-info">Add Information</button>
             </form>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
