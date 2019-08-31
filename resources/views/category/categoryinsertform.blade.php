@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8">
        <div class="card">
          <div class="card-header">
            <h4>Category List</h4>
          </div>
          <div class="card-body">
            <table class="table table-bordered hover">
              <tr>
                <th>SL No</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Created At Ago</th>
                <th>Action</th>
              </tr>
              @forelse($category_infor as $category_info)
              <tr>
                <td>{{  $loop-> index+1 }}</td>
                <td>{{ $category_info-> categorie_name }}</td>
                <td>{{ $category_info-> created_at -> format('d-m-Y h:i:s A') }}</td>
                <td>{{ $category_info-> created_at -> diffForHumans() }}</td>
                <td>
                  <div class="btn-group">
                    <a href="{{ url('category/edit/form') }}/{{ $category_info-> id }}" class="btn btn-success">Edit</a>
                    <a href="{{ url('categorydelete') }}/{{ $category_info-> id }}" class="btn btn-danger">Delete</a>
                  </div>
                </td>
              </tr>
            @empty
              <tr class="text-center text-danger">
                <th colspan="3">Data Not Available</th>
              </tr>
            @endforelse
            </table>
          </div>
        </div>
      </div>
      <div class="col-4">
        <div class="card">
{{-- Category Errors Alert --}}
             @if ($errors->all())
                 <div class="alert alert-success">
                  @foreach ($errors->all() as $error)
                    {{ $error }}
                  @endforeach
                 </div>
             @endif
{{-- Category Add Alert --}}
             @if (session('status'))
               <div class="alert alert-success">
                 {{ session('status') }}
               </div>
             @endif
          <div class="card-header">
            <h4>Add Category Form</h4>
          </div>
          <div class="card-body">
            <form  action="{{ url('category/insert/form/post') }}" method="post">
              @csrf
              <div class="form-group">
                <label>Category</label>
                <input type="text" name="categorie_name" class="form-control" placeholder="Enter your category name" value="{{ old('categorie_name') }}">
              </div>
              <button type="submit" class="btn btn-success">Add Category</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
