@extends('admin.layouts.modal')

@section('title', '用户个人头像上传')

@section('content')
  <form id="avatar-crop-form" method="post" action="">
    @csrf
    @method('POST')

    <div class="form-group clearfix">
      <div class="col-md-offset-2 col-md-8 controls">
        <img class="img-responsive" src="{{ $uri }}" id="avatar-crop" width="250" height="250"
             data-natural-width="270" data-natural-height="1024">
        <div class="help-block">提示：请选择图片裁剪区域。</div>
      </div>
    </div>

    <div class="form-group clearfix">
      <div class="col-md-offset-2 col-md-8 controls">
        <a class="btn btn-fat btn-primary" id="upload-avatar-btn" data-url=""
           data-goto-url="">保存</a>
      </div>
    </div>
  </form>
@stop

@section('footer')
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">保存</button>
@stop

@section('script')
  <script>app.load('user/avatar-crop')</script>
@stop
