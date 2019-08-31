@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h4>Product List</h4>
          </div>
          <div class="card-body">
            <table class="table  table-bordered table-hover">
              <tr class="table-info">
                <th>Product Name</th>
                <th>Category Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
                <th>Product Image</th>
                <th>Product Description</th>
                <th>Action</th>
              </tr>
              @forelse ($select_products as $select_product)
                <tr>
                  <td>{{ $select_product -> product_name }}</td>
                  {{-- <td>{{ App\Category::find($select_product -> categorie_id)-> categorie_}}</td> --}}
                  <td>{{ $select_product  -> relationcategory -> categorie_name }}</td>
                  <td>{{ $select_product -> product_price }} tk</td>
                  <td>{{ $select_product -> product_quantity }}</td>
                  <td>
                    <img src="{{ asset('upload/product_images') }}/{{ $select_product -> product_image }}" alt="Not Found" width="90px">
                  </td>
                  <td>{{ $select_product -> product_description }}</td>
                  <td>
                    <div class="btn-group">
                      <a href="{{ url('product/edit') }}/{{ $select_product -> id }}" class="btn btn-md btn-primary " href="#">Edit</a>
                      <a href="{{ url('product/delete') }}/{{ $select_product-> id }}" class="btn btn-md btn-danger " href="#">Delete</a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="text-center text-danger">
                  <th colspan="7">Data Not Available</th>
                </tr>
              @endforelse
            </table>
            {{ $select_products->links() }}
          </div>
        </div>
      </div>

      <div class="col-4">
        <div class="card">
          @if (session('status'))
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-header">
            <h4>Add Product Form</h4>
          </div>
          <div class="card-body">
            {{-- {{ print_r($errors) }} --}}
            @if ($errors->all())
              <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach

              </div>
            @endif

            <form action="{{ url('product/insert/form/post') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Category Name</label>
                <select class="form-control" name="category_id">
                  <option value="">--Select One--</option>
                  @foreach ($select_categories as $category)
                    <option value="{{ $category-> id }}">{{ $category-> categorie_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control" name="product_name" placeholder="Enter product name" value="{{ old('product_name')}}">
              </div>
              <div class="form-group">
                <label>Product Price</label>
                <input type="text" class="form-control" name="product_price" placeholder="Enter product price" value="{{ old('product_price')}}">
              </div>
              <div class="form-group">
                <label>Product Quantity</label>
                <input type="text" class="form-control" name="product_quantity" placeholder="Enter product quantity" value="{{ old('product_quantity')}}">
              </div>
              <div class="form-group">
                <label>Alert Quantitiy</label>
                <input type="text" class="form-control" name="alert_quantity" placeholder="Enter product alert quantity" value="{{ old('alert_quantity')}}">
              </div>
              <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" name="product_description" rows="3" >{{ old('product_description') }}</textarea>
              </div>
              <div class="form-group">
                <label>Product Image</label>
                <input type="file" class="form-control" name="product_image">
              </div>
              <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
