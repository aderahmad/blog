@extends('layouts.main')

@section('container')   
    <h1 class="mb-3 text-center">{{ $title }}</h1>

    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="{{ route('web.posts') }}">
                @if (request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}" />
                @endif
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="{{ request('search') }}">
                    <button class="btn btn-danger" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>

    @if($posts->count())
    <div class="card mb-3">
    @if($posts[0]->image)
                <div style="max-height:350px;overflow:hidden;">
                <img src="{{ asset('storage/'.$posts[0]->image) }}" class="img-fluid" alt="{{ $posts[0]->category->name }}">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{ $posts[0]->category->name }}" class="img-fluid" alt="{{ $posts[0]->category->name }}">
                @endif
        <div class="card-body text-center">
            <h3 class="card-title"><a href="{{ route('web.post', $posts[0]->slug) }}" class="text-decoration-none text-dark">{{ $posts[0]->title }}</a></h3>
            <p><small class="text-muted">
            <a href="{{ route('web.posts', 'author='.$posts[0]->pengguna->username) }}" class="text-decoration-none">By : {{ $posts[0]->pengguna->name }}</a> in <a href="{{ route('web.posts', 'category='.$posts[0]->category->slug) }}" class="text-decoration-none"> {{ $posts[0]->category->name   }}</a> {{ $posts[0]->created_at->diffForHumans() }}</small>
            </p>
            <p class="card-text">T{{ $posts[0]->excerpt }}</p>
            <a href="{{ route('web.post', $posts[0]->slug) }}" class="text-decoration-none btn btn-primary">
            Read more..
        </a>
        </div>
    </div>

    <div class="container">
        <div class="row">
        @foreach ($posts->skip(1) as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
            <div class="position-absolute px-3 py-2 text-white" style="background-color:rgba(0, 0, 0, 0.6)"><a href="{{ route('web.posts', 'category='.$post->category->slug) }}" class="text-decoration-none text-light">{{ $post->category->name }}</a></div>
            @if($post->image)
                <div style="max-height:350px;overflow:hidden;">
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
                </div>
                @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="img-fluid" alt="{{$post->category->name }}">
                @endif
            <div class="card-body">
                <h5 class="card-title"><a href="{{ route('web.post', $post->slug) }}" class="text-decoration-none text-dark"><h2>{{ $post->title }}<a></h5>
                <p><small class="text-muted">
                <a href="{{ route('web.posts', 'author='.$post->pengguna->username) }}" class="text-decoration-none">By : {{ $post->pengguna->name }}</a> {{ $post->created_at->diffForHumans() }}</small>
                </p>
                <p class="card-text">{{ $post->excerpt }}</p>
                <a href="{{ route('web.post', $post->slug) }}" class="btn btn-primary">Read more..</a>
            </div>
            </div>
        </div>
        @endforeach 
        </div>
    </div>

    @else 
        <p class="text-center fs-4">No Post Found</p>
    @endif

    {{ $posts->links() }}

@endsection