@extends('admin.layouts.modal')

@section('title', '编辑用户个人简介')

@section('content')
  <form id="user-edit-form" class="form-horizontal" method="post"
        action="{{ route('admin.users.update', $user->id) }}" novalidate="novalidate"
        data-widget-cid="widget-28">
    @csrf
    @method('PATCH')
    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="name-field">姓名</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="name-field" name="name" class="form-control" value="{{ $user->name }}"
               data-widget-cid="widget-29" data-explain="">
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
        <label for="mobile">手机号码</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="mobile" name="mobile" class="form-control" value="" data-widget-cid="widget-33"
               data-explain="">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="signature">个人签名</label>
      </div>
      <div class="col-md-7 controls">
        <textarea type="text" rows="4" maxlength="80" id="signature" name="signature" class="form-control"></textarea>
      </div>
    </div>
    <p></p>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="about">自我介绍</label>
      </div>
      <div class="col-md-7 controls">
          <textarea id="about" name="about" data-image-upload-url=""
                    style="visibility: hidden; display: none;"></textarea>
      </div>
    </div>
    <p></p>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="site">个人主页</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="site" name="site" class="form-control" value="" data-widget-cid="widget-32"
               data-explain="">
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
  <script>app.load('user/edit-modal')</script>
@stop
