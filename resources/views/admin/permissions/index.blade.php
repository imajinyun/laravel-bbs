@extends('admin.layouts.app')

@section('title', '角色管理')

@section('sidebar')
  @php($sidebar = 'system')
@stop

@section('content')
  <form id="role-search-form" class="form-inline well well-sm" action="" method="get" novalidate="">
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
    <div class="form-group">
      <input type="text" id="keyword" name="keyword" class="form-control" value="" placeholder="关键词">
    </div>
    <button class="btn btn-primary">搜索</button>
  </form>
  <table id="user-table" class="table table-striped table-hover" data-search-form="#user-search-form">
    <thead>
    <tr>
      <th>角色名称</th>
      <th>守卫名称</th>
      <th>创建时间</th>
      <th>更新时间</th>
      <th width="10%">操作</th>
    </tr>
    </thead>
    <tbody>
    @if (count($permissions))
      @foreach($permissions as $permission)
        <tr>
          <td>{{ $permission->name }}</td>
          <td>{{ $permission->created_at }}</td>
          <td>{{ $permission->updated_at }}</td>
          <td></td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>
@stop
