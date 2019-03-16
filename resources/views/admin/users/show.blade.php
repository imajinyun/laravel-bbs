@extends('admin.layouts.modal')

@section('title', '查看用户个人简介')

@section('content')
  <table class="table table-striped table-condenseda table-bordered">
    <tbody>
    <tr>
      <th width="25%">用户名</th>
      <td width="75%">
        <a class="pull-right" href="{{ route('users.show', $user->id) }}" target="_blank">个人主页</a>
        {{ $user->name }}
      </td>
    </tr>
    <tr>
      <th>Email</th>
      <td>{{ $user->email }}</td>
    </tr>
    <tr>
      <th>用户组</th>
      <td>站长&nbsp;维护者&nbsp;用户</td>
    </tr>
    <tr>
      <th>注册时间/IP</th>
      <td>{{ $user->created_at->diffForHumans() }} / 127.0.0.1 本地地址</td>
    </tr>
    <tr>
      <th>最近登录时间/IP</th>
      <td>2019-3-15 10:38:59 / 192.168.33.1 局域网</td>
    </tr>
    <tr>
      <th>姓名</th>
      <td>{{ $user->name }}</td>
    </tr>
    <tr>
      <th>性别</th>
      <td>秘密</td>
    </tr>
    <tr>
      <th>手机号码</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>职业</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>头衔</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>个人签名</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>自我介绍</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>个人网站</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>微博</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>微信</th>
      <td>暂无</td>
    </tr>
    <tr>
      <th>QQ</th>
      <td>暂无</td>
    </tr>
    </tbody>
  </table>
@stop

@section('footer')
  <button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>
@stop
