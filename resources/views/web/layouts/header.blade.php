<nav class="navbar navbar-expand-md navbar-light shadow-sm bbs-navbar">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">
            {{ config('app.name', 'LaravelBBS') }}
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active_class(if_route('topics.index')) }}">
                    <a href="{{ route('topics.index') }}" class="nav-link">话题</a>
                </li>
                <li class="nav-item {{ nav_active_class(1) }}">
                    <a href="{{ route('categories.show', 1) }}" class="nav-link">分享</a>
                </li>
                <li class="nav-item {{ nav_active_class(2) }}">
                    <a href="{{ route('categories.show', 2) }}" class="nav-link">教程</a>
                </li>
                <li class="nav-item {{ nav_active_class(3) }}">
                    <a href="{{ route('categories.show', 3) }}" class="nav-link">对话</a>
                </li>
                <li class="nav-item {{ nav_active_class(4) }}">
                    <a href="{{ route('categories.show', 4) }}" class="nav-link">公告</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
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
                <li class="nav-item">
                    <a class="nav-link mt-1 mr-3 font-weight-bold" href="{{ route('topics.create') }}">
                        <i class="fa fa-plus"></i>
                    </a>
                </li>
                <li class="nav-item notification-badge">
                    @php
                    $badge = Auth::user()->notification_count > 0 ? 'danger' : 'secondary';
                    @endphp
                    <a href="{{ route('notifications.index') }}" title="消息提醒"
                        class="nav-link mr-3 font-weight-bold badge badge-pill badge-{{ $badge }} text-white">{{ Auth::user()->notification_count }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="img-responsive img-circle" width="30px" height="30px"
                            src="{{ cdn_aliyun(Auth::user()->avatar) }}">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @hasrole('Administrator')
                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                            <i class="fa fa-tachometer mr-2"></i> 管理后台
                        </a>
                        @endhasrole
                        <a class="dropdown-item" href="{{ route('users.show', Auth::id()) }}">
                            <i class="fa fa-user mr-2"></i> 个人中心
                        </a>
                        <a class="dropdown-item" href="{{ route('users.edit', Auth::id()) }}">
                            <i class="fa fa-edit mr-2"></i> 编辑资料
                        </a>
                        <div class="dropdown-divider"></div>
                        <a id="logout" class="dropdown-item" href="#">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-block btn-danger" type="submit" name="button">
                                    <i class="fa fa-sign-out"></i> {{ __('Logout') }}
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
