<nav class="navbar navbar-expand-md navbar-light shadow-sm bbs-navbar">
  <div class="container">
    <a href="{{ url('/') }}" class="navbar-brand">
      {{ config('app.name', 'LaravelBBS') }}
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
            >
              <img src="https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Awesome8dae1Coer.jpg"
                   class="img-responsive img-circle"
                   width="30px"
                   height="30px"
              >
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}"><i class="fa fa-user"></i> 个人中心</a>
              <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}"><i class="fa fa-edit"></i> 编辑资料</a>
              <div class="dropdown-divider"></div>
              <a id="logout" class="dropdown-item" href="#">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button class="btn btn-block btn-danger" type="submit" name="button">
                    <i class="fa fa-sign-out-alt"></i> {{ __('Logout') }}
                  </button>
                </form>
              </a>
            </div>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
