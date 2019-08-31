@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <div class="card">
        <div class="card-header">
          Slider List
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tr>
              <th>SL NO</th>
              <th>Slider Name</th>
              <th>Slider Image</th>
              <th>Action</th>
            </tr>
          @foreach ($sliders as $slider)
            <tr>
              <td>{{ $loop-> index+1 }}</td>
              <td>{{ $slider-> slider_name }}</td>
              <td>
                <img src="{{ asset('upload\slider_images') }}/{{  $slider-> slider_image }}" alt="" width="100px">
              </td>
              <td>
                <div class="btn-group">
                  <a href="#" class="btn btn-info ">Edit</a>
                  <a href="#" class="btn btn-danger ">Delete</a>
                </div>
              </td>
            </tr>
          @endforeach
          </table>
        </div>
      </div>
    </div>
    <div class="col-4">
      <div class="card">
        @if (session('add'))
          <div class="alert alert-success">
            {{ session('add') }}
          </div>
        @endif
        @if ($errors->all())
            <div class="alert alert-danger">
              @foreach ($errors->all() as $error)
                {{ $error }}
              @endforeach
            </div>
        @endif
        <div class="card-header">
          Add Slider
        </div>
        <div class="card-body">
          <form action="{{ url('slider/insert/form/post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Slider Title</label>
              <input type="text" class="form-control" name="slider_name" value="{{ old('slider_name') }}">
            </div>
            <div class="form-group">
              <label>Slider Image</label>
              <input type="file" class="form-control" name="slider_image" >
            </div>
            <button type="submit" class="btn btn-info">Add Slider</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
