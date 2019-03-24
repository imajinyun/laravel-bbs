@extends('admin.layouts.modal')

@section('title', '编辑角色')

@section('content')
  <form id="role-add-form" class="form-horizontal" action="{{ route('admin.roles.update', $role) }}"
        method="post" novalidate="novalidate">
    @csrf
    @method('PATCH')

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="name">名称</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}"
               data-url="{{ route('admin.roles.check.name') }}">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="signature">个人签名</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="test" name="test" class="form-control" value=""
               data-url="{{ route('admin.roles.check.name') }}">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label>权限</label>
      </div>
      <div class="col-md-7 controls">
        <ul class="ztree" id="tree">
          <textarea style="display: none;">{{ $menus }}</textarea>
        </ul>
      </div>
    </div>

    <input type="hidden" name="menus" id="menus" value="">
  </form>
@stop

@section('footer')
  <button class="btn btn-primary pull-right" id="role-add-btn" type="submit"
          data-submiting-text="正在提交..." data-toggle="form-submit"
          data-target="#role-add-form">保存
  </button>
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">取消</button>
@stop

@section('script')
  <script>app.load('role/edit')</script>
@stop
