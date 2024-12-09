<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgba(149, 0, 255,0.6)">
  <div class="container">
    <a class="navbar-brand {{ Request::is('home') ? 'active' : '' }}" href="{{ route('web.home') }}">Wibu Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Home') ? 'active' : '' }} "  href="{{ route('web.home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'About') ? 'active' : '' }}" href="{{ route('web.about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'All Posts') ? 'active' : '' }}" href="{{ route('web.posts') }}">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ ($title === 'Post Categories') ? 'active' : '' }}" href="{{ route('web.categories') }}">Categories</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="{{ route('dashboard.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> My Dashboard</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout.proses-logout') }}"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
          </ul>
        </li>
        @else
        <li class="nav-item">
          <a href="{{ route('login.form-login') }}" class="nav-link {{ ($title === 'login') ? 'active' : '' }}"><i class="bi bi-box-arrow-in-right"></i> Login</a>
        </li>
        @endauth
      </ul>
      
    </div>
  </div>
</nav>