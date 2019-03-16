@extends('admin.layouts.modal')

@section('title', '重置用户个人密码')

@section('content')
  <form class="form-horizontal" id="password-reset-form" action="{{ route('admin.password.reset', $user) }}"
        method="post" novalidate="novalidate">
    @csrf
    @method('PATCH')

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="code">用户名</label></div>
      <div class="col-md-8 controls">
        <div style="margin-top: 7px;">{{ $user->name }}</div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="code">用户邮箱</label></div>
      <div class="col-md-8 controls">
        <div style="margin-top: 7px;">{{ $user->email }}</div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="newPassword">新密码</label></div>
      <div class="col-md-8 controls">
        <input class="form-control" type="password" id="newPassword" value="" name="newPassword"
               data-explain="5-20位英文、数字、符号，区分大小写">
        <p class="help-block"></p>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="confirmPassword">确认密码</label></div>
      <div class="col-md-8 controls">
        <input class="form-control" type="password" id="confirmPassword" value="" name="confirmPassword"
               data-explain="再输入一次密码">
        <p class="help-block"></p>
      </div>
    </div>
    <input type="hidden" name="id" value="{{ $user->id }}">
  </form>
@stop

@section('footer')
  <button class="btn btn-primary pull-right" id="password-reset-btn" type="submit"
          data-submiting-text="正在提交..." data-toggle="form-submit"
          data-target="#password-reset-form">保存
  </button>
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">取消</button>
@stop

@section('script')
  <script>app.load('user/password-reset')</script>
@stop
