@extends('layouts.main')

@section('container')

    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1>{{ $post->title }}</h1>
                <h5>By : <a href="{{ route('web.posts', 'author='.$post->pengguna->username) }}" class="text-decoration-none">{{ $post->pengguna->name }}</a> in <a href="{{ route('web.posts', 'category='.$post->category->slug) }}" class="text-decoration-none"> {{ $post->category->name   }}</a></h5>
                @if($post->image)
                <div style="max-height:350px;overflow:hidden;">
                <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
                </div>
                @else
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="img-fluid" alt="{{$post->category->name }}">
                @endif
                <article class="my-3 fs-5">
                    <p>{!! $post->body !!}</p>
                </article>
                <a href="{{ route('web.posts') }} " class="d-block mt-3 text-decoration-none">Kembali</a>
            </div>
        </div>
    </div>        
@endsection