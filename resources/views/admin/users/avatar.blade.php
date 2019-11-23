@extends('admin.layouts.modal')

@section('title', '用户个人头像上传')

@section('content')
  <form class="form-horizontal" id="user-avatar-form" method="post" enctype="multipart/form-data"
        action="{{ route('admin.avatar.crop', $user) }}">
    <div class="form-group">
      <div class="col-md-2 control-label"><b>当前头像</b></div>
      <div class="controls col-md-8 controls">
        <img class="img-thumbnail" src="{{ filepath($user->avatar, 'avatar') }}"
             id="avatar-crop" width="250" height="250">
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-2 control-label">
      </div>
      <div class="controls col-md-8 controls">
        <p class="help-block">
          请上传 jpg|gif|png 格式的图片，建议图片尺寸为 250×250px，建议图片大小不超过
          <strong>2MB</strong>，
          <a href="#" target="_blank">如何制作合适的图片？</a>
        </p>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-2 control-label"></div>
      <div class="controls col-md-8 controls">
        <a class="btn btn-primary upload-avatar-btn webuploader-container" id="upload-avatar-btn"
           data-upload-token="{{ upload_token('tmp') }}"
           data-goto-url="{{ route('admin.avatar.crop', $user) }}">
          <div class="webuploader-pick">上传新头像</div>
        </a>
      </div>
    </div>
  </form>
@stop

@section('footer')
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">取消</button>
@stop

@section('script')
  <script>app.load('user/avatar')</script>
@stop
