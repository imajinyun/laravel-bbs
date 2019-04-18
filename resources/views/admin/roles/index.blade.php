@extends('admin.layouts.app')

@section('title', '角色管理')

@section('sidebar')
  @php($sidebar = 'system')
@stop

@section('action')
  <a class="btn btn-success btn-sm" data-url="{{ route('admin.roles.create') }}"
     data-toggle="modal" data-target="#modal">添加角色</a>
@stop

@section('content')
  <form id="role-search-form" class="form-inline well well-sm" action="" method="get" novalidate="novalidate">
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
      <th>角色编码</th>
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
          <td>{{ $role->slug }}</td>
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
          <td>
            <div class="btn-group">
              <a href="#modal" data-toggle="modal" data-url="{{ route('admin.roles.show', $role) }}"
                 class="btn btn-default btn-sm">查看</a>
              <a href="#" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#modal" data-toggle="modal" data-url="{{ route('admin.roles.edit', $role) }}"
                     data-target="#modal" title="编辑用户信息">编辑角色</a>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
  {!! $roles->appends(Request::except('page'))->render() !!}
@stop
