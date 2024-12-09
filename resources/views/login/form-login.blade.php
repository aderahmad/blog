@extends('layouts.main')

@section('container')
@if (session()->has('login_gagal'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('login_gagal') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">{{ session('error') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row justify-content-center">
    <div class="col-md-5">
    <main class="form-signin">
  <form action="{{ route('login.proses-login') }}" method="post">
  @csrf
      <h1 class="h3 mb-3 fw-normal text-center">Login</h1>
        <div class="form-floating">
      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="{{ old('email') }}" required>
      <label for="email">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{ old('password') }}" required>
      <label for="password">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
  </form>
  <div class="d-flex" style="justify-content:space-between;">
  <small class="d-block text-center mt-3"><a href="{{ route('forgot.form-forgot') }}">forgot password</a></small>
  <small class="d-block text-center mt-3">Not Registered? <a href="{{ route('register.form-register') }}">Register now!</a></small>
</div>
</main>
    </div>
</div>
@endsection