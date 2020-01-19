<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- STYLES --}}
  <link href="{{ asset('vendor/blog/css/app.css') }}" rel="stylesheet">
</head>
<body>

  {{-- NAVIGATION SECTION --}}
  <nav class="navbar navbar-expand-md">
    <div class="container">
      <a class="navbar-brand text-primary" href="{{ url('/') }}">
        <img src="/blog_logo.png" width="45" height="45" alt="">
      </a>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Blog
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('posts.index') }}">
              Posts
            </a>

            <div class="dropdown-divider"></div>

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>

  <main id="main" class="my-4">
    @yield('content')
  </main>
</body>

<!-- Scripts -->

<script type="text/javascript" src="{{ asset('vendor/blog/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('vendor/blog/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
var element =  document.getElementById('editor');
if (typeof(element) != 'undefined' && element != null) {
  CKEDITOR.replace("editor");
}
</script>
</html>
