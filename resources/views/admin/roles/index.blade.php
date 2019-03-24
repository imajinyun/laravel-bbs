@extends('admin.layouts.app')

@section('title', '角色管理')

@section('content')
  <div class="row">
    <div class="col-md-2">
      <div class="list-group left-navbar">
        <a href="{{ route('admin.users.index') }}" class="list-group-item" id="admin_menu_user" title="用户管理">
          用户管理
        </a>
        <a href="#" class="list-group-item active" id="admin_menu_role" title="角色管理">
          角色管理
        </a>
      </div>
    </div>
    <div class="col-md-10">
      <div class="page-header clearfix">
        <h1 class="pull-left">用户管理</h1>
        <div class="pull-right">
          <a class="btn btn-success btn-sm" data-url="{{ route('admin.users.create') }}"
             data-toggle="modal" data-target="#modal">添加新用户</a>
        </div>
      </div>
      <ul class="nav nav-tabs mbm">
        <li class="active">
          <a title="角色管理" class="" href="{{ route('admin.roles.index') }}">角色管理</a>
        </li>
        <li>
          <a title="在线用户" class="" href="#">在线用户</a>
        </li>
      </ul>
      <form id="role-search-form" class="form-inline well well-sm" action="" method="get" novalidate="">
        <select class="form-control" name="datePicker" id="datePicker">
          <option value="">--时间类型--</option>
          <option value="longinDate">登录时间</option>
          <option value="registerDate">注册时间</option>
        </select>
        <div class="form-group ">
          <input class="form-control" type="text" id="startDate" name="startDate" value="" placeholder="起始时间">
          -
          <input class="form-control" type="text" id="endDate" name="endDate" value="" placeholder="结束时间">
        </div>
        <div class="form-group">
          <input type="text" id="keyword" name="keyword" class="form-control" value="" placeholder="关键词">
        </div>
        <button class="btn btn-primary">搜索</button>
      </form>
      <p class="text-muted">
        <span class="mrl">用户总数：<strong class="inflow-num">{{ $count }}</strong></span>
      </p>
      <table id="user-table" class="table table-striped table-hover" data-search-form="#user-search-form">
        <thead>
        <tr>
          <th>角色名称</th>
          <th>守卫名称</th>
          <th>创建时间</th>
          <th>更新时间</th>
          <th width="10%">操作</th>
        </tr>
        </thead>
        <tbody>
        @if (count($roles))
          @foreach($roles as $key => $role)
            <tr id="user-table-tr-{{ $key }}">
              <td>
                <strong>
                  <a href="javascript:;" role="show-user" data-toggle="modal" data-target="#modal"
                     data-url="#">{{ $role->name }}</a>
                </strong>
                <br>
                <span class="text-muted text-sm">站长 维护者 用户</span>
              </td>
              <td>{{ $role->guard_name }}</td>
              <td>
                <span class="text-sm">{{ $role->created_at }}</span>
                <br>
                <span class="text-muted text-sm"><a href="#" target="_blank">127.0.0.1</a> 本机地址</span>
                <span></span>
              </td>
              <td>
                <span class="text-sm">2019-3-15 10:38:59</span>
                <br>
                <span class="text-muted text-sm">
                  <a class="text-muted text-sm" href="#" target="_blank">192.168.33.1</a>局域网
                </span>
              </td>
              <td></td>
            </tr>
          @endforeach
        @endif
        </tbody>
      </table>
      {{--      {!! $users->appends(Request::except('page'))->render() !!}--}}
    </div>
  </div>
@stop