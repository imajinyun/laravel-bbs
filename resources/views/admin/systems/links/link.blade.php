@extends('admin.layouts.modal')

@section('title', $link->id ? '编辑友情链接' : '添加友情链接'))

@section('content')
  <form class="form-horizontal" id="navigation-form" method="post"
        action="{{ $link->id ? route('admin.systems.links.update', $link->id) : route('admin.systems.links.store') }}"
        novalidate="novalidate">
    @csrf
    @method($link->id ? 'PATCH' : 'POST')

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="name">链接名称</label></div>
      <div class="col-md-8 controls">
        <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $link->name) }}"
               data-explain="">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label"><label for="href">链接地址</label></div>
      <div class="col-md-8 controls">
        <input class="form-control" type="text" id="href" name="href" value="{{ old('href', $link->href) }}"
               placeholder="http://">
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label"><label>新开窗口</label></div>
      <div class="col-md-8 controls radios">
        <div id="isNewWin">
          <input type="radio" name="isNewWin" value="0" checked="checked">
          <label>否</label>
          <input type="radio" name="isNewWin" value="1">
          <label>是</label>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-3 control-label">
        <label>状态</label>
      </div>
      <div class="col-md-8 controls radios">
        <div id="isOpen">
          <input type="radio" name="isOpen" value="1" checked="checked">
          <label>开启</label>
          <input type="radio" name="isOpen" value="0">
          <label>禁用</label>
        </div>
      </div>
    </div>

  </form>
@stop

@section('footer')
  <button type="button" class="btn btn-link" data-dismiss="modal">取消</button>
  <button id="navigation-save-btn" data-submiting-text="正在提交..." type="submit" class="btn btn-primary"
          data-toggle="form-submit" data-target="#navigation-form">保存
  </button>
@stop

@section('script')
  <script>app.load('setting/link')</script>
@stop
