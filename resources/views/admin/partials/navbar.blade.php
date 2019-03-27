<ul class="nav navbar-nav">
  @foreach ($navbars as $navbar)
    <li class="">
      <a href="{{ route($navbar['uri']) }}" title="{{ $navbar['name'] }}">{{ $navbar['name'] }}</a>
    </li>
  @endforeach
</ul>

<ul class="nav navbar-nav navbar-right">
  <li data-url="#" class="">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
      <span class="glyphicon glyphicon-list admin-star"></span> 常用
    </a>
    <ul class="dropdown-menu shortcuts">
      <li class="shortcut-add" data-url="#">
        <a href="javascript:;"><i class="glyphicon glyphicon-plus"></i> 添加当前页面为常用功能</a>
      </li>
    </ul>
  </li>
  <li><a href="{{ route('topics.index') }}"><i class="glyphicon glyphicon-home"></i> 回首页</a></li>
  <li class="dropdown">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
      <i class="glyphicon glyphicon-user"></i> {{ auth()->user()->name }}
      <span class="glyphicon glyphicon-chevron-down"></span>
    </a>
    <ul class="dropdown-menu main-list">
      <li>
        <a href="#"><i class="es-icon es-icon-event mrs" style="vertical-align: middle;"></i>我的中心</a>
      </li>
      <li><a href="#"><i class="es-icon es-icon-book mrs"></i>我的学习</a></li>
      <li>
        <a href="#">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-block btn-sm btn-danger" type="submit" name="button">
              <i class="glyphicon glyphicon-off"></i> {{ __('Logout') }}
            </button>
          </form>
        </a>
      </li>
    </ul>
  </li>
</ul>
