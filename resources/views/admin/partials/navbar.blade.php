<ul class="nav navbar-nav">
  <li id="menu_admin_user">
    <a title="用户" href="{{ route('admin.users.index') }}">用户</a>
  </li>
  <li id="menu_admin_operation">
    <a title="运营" href="#">运营</a>
  </li>
  <li id="menu_admin_system">
    <a title="系统" href="#">系统</a>
  </li>
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
      <i class="glyphicon glyphicon-user"></i> 用户名
      <span class="glyphicon glyphicon-chevron-down"></span>
    </a>
    <ul class="dropdown-menu main-list">
      <li>
        <a href="#"><i class="es-icon es-icon-event mrs" style="vertical-align: middle;"></i>我的中心</a>
      </li>
      <li><a href="#"><i class="es-icon es-icon-book mrs"></i>我的学习</a></li>
      <li><a href="{{ route('logout') }}"><i class="glyphicon glyphicon-off"></i> 退出</a></li>
    </ul>
  </li>
</ul>
