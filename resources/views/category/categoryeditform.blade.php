@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashbord</a></li>
            <li class="breadcrumb-item"><a href="{{ url('category/insert/form') }}">Category List</a></li>
            <li class="breadcrumb-item active" aria-current="page"></li>
          </ol>
        </nav>
        <div class="card">
  {{-- Category Errors Alert --}}
          @if ($errors->all())
              <div class="alert alert-success">
               @foreach ($errors->all() as $error)
                 {{ $error }}
               @endforeach
              </div>
          @endif
  {{-- Category edit Alert --}}
          @if (session('status'))
            <div class="alert alert-info">
              {{ session('status') }}
            </div>
          @endif
          <div class="card-header">
            <h4>Edit Category Form</h4>
          </div>
          <div class="card-body">
            <form  action="{{ url('category/edit/form/post') }}" method="post">
              @csrf
              <div class="form-group">
                <label>Category</label>
                <input type="hidden" name="categorie_id" class="form-control"  value="{{ $categoris->	id }}">
                <input type="text" name="categorie_name" class="form-control"  value="{{ $categoris->	categorie_name }}">
              </div>
              <button type="submit" class="btn btn-success">Edit Category</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
