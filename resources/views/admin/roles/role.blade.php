@extends('admin.layouts.modal')

@section('title', $role->id ? '编辑角色' : '添加角色')

@section('content')
  <form class="form-horizontal" id="role-form"
        action="{{ $role->id ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
        method="post" novalidate="novalidate">
    @csrf
    @method('POST')

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="name">角色名称</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" class="form-control" id="name" name="name"
               value="{{ old('name', $role->name) }}"
               data-url="{{ route('admin.roles.check.name', $role->id) }}">
        <div class="help-block" style="display:none;"></div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-2 control-label">
        <label for="signature">角色编码</label>
      </div>
      <div class="col-md-7 controls">
        <input type="text" id="slug" name="slug" class="form-control"
               value="{{ old('slug', $role->slug) }}"
               data-url="{{ route('admin.roles.check.slug', $role->id) }}">
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
  <button class="btn btn-primary pull-right" id="role-btn" type="submit"
          data-submiting-text="正在提交..." data-toggle="form-submit"
          data-target="#role-form">保存
  </button>
  <button type="button" class="btn btn-link pull-right" data-dismiss="modal">取消</button>
@stop

@section('script')
  <script>app.load('role/role')</script>
@stop
