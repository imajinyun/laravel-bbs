@extends('admin.layouts.modal')

@section('title', '编辑用户个人简介')

@section('content')
  <form class="form-horizontal" id="user-edit-form" method="post"
        action="{{ route('admin.users.update', $user->id) }}" novalidate="novalidate">
    @csrf
    @method('PATCH')
    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="name">姓名</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" data-explain="">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="gender">性别</label>
      </div>
      <div class="col-md-7 controls radios">
        <div id="gender">
          <input type="radio" id="gender_0" name="gender" value="male">
          <label for="gender_0">男</label>
          <input type="radio" id="gender_1" name="gender" value="female">
          <label for="gender_1">女</label>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="phone">手机号码</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" name="phone" id="phone" class="form-control" value="" data-explain="">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="signature">个人签名</label>
      </div>
      <div class="col-md-7 controls">
        <textarea type="text" rows="4" maxlength="80" name="signature" id="signature" class="form-control"></textarea>
      </div>
    </div>
    <p></p>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="introduction">自我介绍</label>
      </div>
      <div class="col-md-7 controls">
        <textarea name="introduction" id="introduction" data-image-upload-url=""
                  style="visibility: hidden; display: none;"></textarea>
      </div>
    </div>
    <p></p>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="site">个人主页</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" name="site" id="site" class="form-control" value="" data-explain="">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>
    <p></p>
  </form>
@stop

@section('footer')
  <button id="edit-user-btn" data-submiting-text="正在提交..." type="submit" class="btn btn-primary pull-right"
          data-toggle="form-submit" data-target="#user-edit-form">保存
  </button>
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">取消</button>
@stop

@section('script')
  <script>app.load('user/edit')</script>
@stop
