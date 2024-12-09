@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">My Post</h1>
</div>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
  {{ session('success') }}
</div>
@endif
<div class="table-responsive">
    <a href="{{ route('create') }}" class="btn btn-primary mb-2">Create New Post</a>
        <table class="table table-hover table-striped table-sm col-lg-8">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Title</th>
              <th scope="col">Category</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td>
                    <a href="{{ route('show.post', $post->slug) }}"><button class="btn btn-info">Look</button></a>
                    <a href="{{ route('edit', $post->slug) }}"><button class="btn btn-warning">Edit</button></a>
                    <form action="{{ route('delete', $post->slug) }}" method="post" class="d-inline">
                      @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="return confirm('sure?')">Delete</button></form>
                </td>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
        </table>
      </div>
@endsection