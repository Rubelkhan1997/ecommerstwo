@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashbord</a></li>
            <li class="breadcrumb-item"><a href="{{ url('product/inset/form') }}">Product List</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product_edit -> product_name }}</li>
          </ol>
        </nav>
        <div class="card">
          @if (session('status'))
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-header">
            <h4>Edit Product Form</h4>
          </div>
          <div class="card-body">
            {{-- {{ print_r($errors) }} --}}
            <form action="{{ url('product/edit/post') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Category Name</label>
                <select class="form-control" name="category_id">
                  @foreach ($categories as $category)
                    <option value="{{ $category-> id }}" {{ ($product_edit->categorie_id == $category->id)? "Selected":"" }}>{{ $category-> categorie_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Product Name</label>
                <input type="hidden" class="form-control" name="product_id"  value="{{ $product_edit->id }}">
                <input type="text" class="form-control" name="product_name"  value="{{ $product_edit->product_name }}">
              </div>
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control" name="product_price"  value="{{ $product_edit->product_price }}">
              </div>
              <div class="form-group">
                <label>Product Quantity</label>
                <input type="text" class="form-control" name="product_quantity" value="{{ $product_edit->product_quantity  }}">
              </div>
              <div class="form-group">
                <label>Alert Quantitiy</label>
                <input type="text" class="form-control" name="alert_quantity"  value="{{ $product_edit->product_alert_quantity  }}">
              </div>
              <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="product_description" rows="3" >{{ $product_edit->product_description  }}</textarea>
              </div>
              <div class="form-group">
                <label>Product Image</label>
                <input type="file" class="form-control" name="product_image">
              </div>
              <button type="submit" class="btn btn-info">Edit Product</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
