@extends('admin.layouts.app')

@section('title', '友情链接')

@section('sidebar')
  @php($sidebar = 'system')
@stop

@section('action')
  <a class="btn btn-success btn-sm" data-url="{{ route('admin.settings.links.create') }}"
     data-toggle="modal" data-target="#modal">添加友情链接</a>
@stop

@section('content')
  <table id="navigation-table" class="table table-striped table-hover navigation-table sortable-list">
    <thead>
    <tr>
      <th width="50%">名称</th>
      <th width="10%">新开窗口</th>
      <th width="10%">状态</th>
      <th width="30%">操作</th>
    </tr>
    </thead>

    <tbody data-update-seqs-url="/app.php/admin/setting/navigation/seqs/update">
    <tr class="treegrid-4  has-subItems" id="navigations-tr-4" data-id="4" data-parent-id="0">
      <td class="sort-handle" style="vertical-align: middle; "><span class="treegrid-expander"></span>
        <a href="http://www.baidu.com" target="_blank"> 百度 </a>
      </td>
      <td>
        否
      </td>
      <td>
        开启
      </td>
      <td>
        <button class="btn btn-sm btn-default edit-btn" data-url="/app.php/admin/setting/navigation/4/update"
                data-toggle="modal" data-target="#modal">编辑
        </button>
        <button class="btn btn-sm btn-default delete-btn" data-url="/app.php/admin/setting/navigation/4/delete"
                data-target="4">删除
        </button>
      </td>
    </tr>
    </tbody>
  </table>
@stop
