@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Post Categories</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success col-lg-6" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="table-responsive">
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-2">Create New Post</a>
        <table class="table table-hover table-striped table-sm col-lg-6">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Category Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('category.edit', $category->slug) }}"><button class="btn btn-warning">Edit</button></a>
                    <a class="btn btn-danger" href="{{ route('category.delete', $category->slug) }}">Delete</a>
                </td>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
@endsection