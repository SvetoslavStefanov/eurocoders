<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
      <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 text-secondary">{{ __('Home') }}</a></li>
        <li><a href="{{ url('gallery') }}" class="nav-link px-2 text-white">{{ __('Gallery') }}</a></li>
        <li><a href="{{ url('users') }}" class="nav-link px-2 text-white">{{ __('Users') }}</a></li>
        <li><a href="{{ url('contacts') }}" class="nav-link px-2 text-white">{{ __('Contacts') }}</a></li>
      </ul>

      <div class="text-end">
        @guest
          <a class="btn btn-outline-light me-2" href="{{ route('login') }}">{{ __('Login') }}</a>
          <a class="btn btn-warning" href="{{ route('register') }}">{{ __('Register') }}</a>
        @else
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
        @endguest
      </div>
    </div>
  </div>
</header>