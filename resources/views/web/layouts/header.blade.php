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

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li>
          <a href="{{ url('/') }}">首页</a>
        </li>
        <li>
          <a href="#">分享</a>
        </li>
        <li>
          <a href="#">教程</a>
        </li>
        <li>
          <a href="#">对话</a>
        </li>
        <li>
          <a href="#">公告</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto bbs-navbar-right">
        <li class="nav-item">
          <a href="#">用户名</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
