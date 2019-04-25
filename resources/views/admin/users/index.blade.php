@extends('admin.layouts.app')

@section('title', '用户管理')

@section('sidebar')
  @php($sidebar = 'user')
@stop

@section('content')
  <form id="user-search-form" class="form-inline well well-sm" action="" method="get" novalidate="">
    <div class="mbm">
      <select class="form-control" name="datePicker" id="datePicker">
        <option value="">--时间类型--</option>
        {!! select_options(config('blader.userDatetimeType'), Request::query('datePicker')) !!}
      </select>
      <div class="form-group ">
        <input class="form-control" type="text" id="startDate" name="startDate" value="" placeholder="起始时间">
        -
        <input class="form-control" type="text" id="endDate" name="endDate" value="" placeholder="结束时间">
      </div>
    </div>
    <div class="form-group">
      <select class="form-control" name="role">
        <option value="">--所有角色--</option>
        {!! select_options(config('blader.userRole'), Request::query('role')) !!}
      </select>
    </div>
    <div class="form-group">
      <select name="keywordUserType" id="keywordUserType" class="form-control">
        <option value="">--注册来源--</option>
        {!! select_options(config('blader.userType'), Request::query('keywordUserType')) !!}
      </select>
    </div>
    <div class="form-group">
      <select class="form-control" name="keywordType" id="keywordType">
        {!! select_options(config('blader.userKeyWordType'), Request::query('keywordType')) !!}
      </select>
    </div>
    <div class="form-group">
      <input type="text" name="keyword" id="keyword" class="form-control" placeholder="关键词"
             value="{{ Request::query('keyword') }}">
    </div>
    <button class="btn btn-primary">搜索</button>
  </form>
  <p class="text-muted">
    <span class="mrl">用户总数：<strong class="inflow-num">{{ $users->total() }}</strong></span>
  </p>
  <table id="user-table" class="table table-striped table-hover" data-search-form="#user-search-form">
    <thead>
    <tr>
      <th>用户名</th>
      <th>手机号</th>
      <th>Email</th>
      <th>注册时间</th>
      <th>最近登录</th>
      <th width="10%">操作</th>
    </tr>
    </thead>
    <tbody>
    @if (count($users))
      @foreach($users as $key => $user)
        <tr id="user-table-tr-{{ $key }}">
          <td>
            <strong>
              <a href="javascript:;" role="show-user" data-toggle="modal" data-target="#modal"
                 data-url="#">{{ $user->name }}</a>
            </strong>
            <br>
            <span class="text-muted text-sm">站长 维护者 用户</span>
          </td>
          <td>{{ $user->phone ?? '--' }}</td>
          <td>
            {{ $user->email }}
            <br>
            @if ($user->email_verified_at)
              <label class="label label-success" title="该 Email 地址已验证">已验证</label>
            @else
              <label class="label label-danger" title="该 Email 地址未验证">未验证</label>
            @endif
          </td>
          <td>
            <span class="text-sm">{{ $user->created_at->diffForHumans() }}</span>
            <br>
            <span class="text-muted text-sm"><a href="#" target="_blank">127.0.0.1</a> 本机地址</span>
            <span></span>
          </td>
          <td>
            <span class="text-sm">{{ $user->last_actived_at }}</span>
            <br>
            <span class="text-muted text-sm">
              <a class="text-muted text-sm" href="#" target="_blank">192.168.33.1</a>局域网
            </span>
          </td>
          <td>
            <div class="btn-group">
              <a href="#modal" data-toggle="modal" data-url="{{ route('admin.users.show', $user) }}"
                 class="btn btn-default btn-sm">查看</a>
              <a href="#" type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <a href="#modal" data-toggle="modal" data-url="{{ route('admin.users.edit', $user) }}"
                     data-target="#modal" title="编辑用户信息">编辑用户信息</a>
                </li>
                <li>
                  <a href="#modal" data-toggle="modal" data-url="#"
                     data-target="#modal" title="设置用户组">设置用户组</a>
                </li>
                <li>
                  <a href="#modal" data-toggle="modal" data-url="{{ route('admin.avatar.request', $user) }}"
                     data-target="#modal" title="修改用户头像">修改用户头像</a>
                </li>
                <li>
                  <a href="#modal" data-toggle="modal"
                     data-url="{{ route('admin.password.request', $user) }}"
                     data-target="#modal" title="修改密码">修改密码</a>
                </li>
                <li>
                  <a title="发送密码重置邮件" class="send-passwordreset-email"
                     data-url="#" href="javascript:;">发送密码重置邮件</a>
                </li>
                <li>
                  <a title="发送Email验证邮件" class="send-emailverify-email"
                     data-url="#" href="javascript:;">发送Email验证邮件</a>
                </li>
                <li>
                  <a title="封禁用户" class="lock-user" data-url="#" href="javascript:;">
                    封禁用户
                  </a>
                </li>
              </ul>
            </div>
          </td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
  {!! $users->appends(Request::except('page'))->render() !!}
@stop
