@extends('dashboard.layouts.main')

@section('container')
<div class="container">
        <div class="row my-3">
            <div class="col-lg-8">
                <h1>{{ $posts->title }}</h1>
                <div class="mb-2"><a href="{{ route('view.post') }}" class="btn btn-success">back to all my post</a>
                <a href="{{ route('edit', $posts->slug) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('delete', $posts->slug) }}" method="post" class="d-inline">
                      @csrf
                    @method('delete')
                    <button class="btn btn-danger" onclick="return confirm('sure?')">Delete</button></form>


                @if($posts->image)
                <div style="max-height:350px;overflow:hidden;">
                <img src="{{ asset('storage/'.$posts->image) }}" class="img-fluid mt-3" alt="{{ $posts->category->name }}">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts->category->name }}" class="img-fluid mt-3" alt="{{ $posts->category->name }}">
                @endif

                <article class="my-3 fs-5" style="text-align: justify;">
                    <p>{!! $posts->body !!}</p>
                </article>
            </div>
        </div>
    </div> 
@endsection