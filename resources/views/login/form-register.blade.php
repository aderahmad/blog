@extends('layouts.main')

@section('container')
<div class="row justify-content-center">
@if (session('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('error') }} 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">{{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>
  @endif
</div>
<div class="row justify-content-center">
    <div class="col-md-5">
    <main class="form-registration">
  <form action="{{ route('register.proses-register') }}" method="POST">
  {{ csrf_field() }}
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
      <div class="form-floating">
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name">
      <label for="name">Name</label>
    </div>
    <div class="form-floating">
      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="username">
      <label for="username">Username</label>
    </div> 
      <div class="form-floating">
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com">
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
  </form>
  <small class="d-block text-center mt-3">Already Registered? <a href="{{ route('login.form-login') }}">Login</a></small>
</main>
    </div>
</div>
@endsection