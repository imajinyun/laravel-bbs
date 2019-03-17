@extends('admin.layouts.app')

@section('title', '用户管理')

@section('content')
  <div class="row">
    <div class="col-md-2">
      <div class="list-group left-navbar">
        <a id="menu_admin_user_show" title="用户管理" class="list-group-item active"
           href="{{ route('admin.users.index') }}">用户管理</a>
        <a id="menu_admin_user_learn_statistics_manage" title="用户数据统计" class="list-group-item" href="#">
          用户数据统计
        </a>
        <a id="menu_admin_teacher" title="系统维护者" class="list-group-item" href="#">
          系统维护者
        </a>
        <a id="menu_admin_approval_manage" title="实名认证管理" class="list-group-item" href="#">
          实名认证管理
        </a>
        <a id="menu_admin_message_manage" title="私信管理" class="list-group-item" href="#">
          私信管理
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
          <a title="用户管理" class="" href="{{ route('admin.users.index') }}">用户管理</a>
        </li>
        <li>
          <a title="在线用户" class="" href="#">在线用户</a>
        </li>
        <li>
          <a title="登录日志" class="" href="#">登录日志</a>
        </li>
      </ul>
      <form id="user-search-form" class="form-inline well well-sm" action="" method="get" novalidate="">
        <div class="mbm">
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
        </div>
        <div class="form-group"></div>
        <div class="form-group">
          <select class="form-control" name="roles">
            <option value="">--所有角色--</option>
            <option value="ROLE_USER">用户</option>
            <option value="ROLE_MAINTAINER">维护者</option>
            <option value="ROLE_ADMIN">管理员</option>
            <option value="ROLE_FOUNDER">站长</option>
          </select>
        </div>
        <span class="divider"></span>
        <div class="form-group">
          <select id="keywordUserType" name="keywordUserType" class="form-control">
            <option value="">--注册来源--</option>
            <option value="default">网站注册</option>
            <option value="weibo">微博登录</option>
            <option value="web_email">网站邮箱注册</option>
            <option value="web_mobile">网站手机注册</option>
            <option value="import">手动导入</option>
            <option value="qq">QQ登录</option>
            <option value="weixin">微信登录</option>
            <option value="marketing">微营销</option>
            <option value="distributor">分销</option>
          </select>
        </div>
        <div class="form-group">
          <select id="keywordType" name="keywordType" class="form-control">
            <option value="nickname" selected="selected">用户名</option>
            <option value="verifiedMobile">手机号</option>
            <option value="email">邮件地址</option>
            <option value="loginIp">登录IP</option>
          </select>
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
              <td>--</td>
              <td>
                {{ $user->email }}
                <br>
                <label class="label label-success" title="该 Email 地址已验证">已验证</label>
              </td>
              <td>
                <span class="text-sm">{{ $user->created_at->diffForHumans() }}</span>
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
    </div>
  </div>
@stop
