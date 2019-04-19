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

    <tbody data-update-seqs-url="">
    @if (count($links))
      @foreach ($links as $link)
        <tr class="">
          <td class="sort-handle" style="vertical-align: middle;">
            <span class="glyphicon glyphicon-resize-vertical"></span>
            {{ $link->name }}
          </td>
          <td>
            {{ $link->status }}
          </td>
          <td>
            {{ $link->status }}
          </td>
          <td>
            <button class="btn btn-sm btn-default edit-btn"
                    data-url=""
                    data-toggle="modal"
                    data-target="#modal">删除
            </button>
            <button class="btn btn-sm btn-default edit-btn"
                    data-url="" data-toggle="modal"
                    data-target="#modal">编辑
            </button>
          </td>
        </tr>
      @endforeach
    @else
      <tr>
        <td colspan="20">
          <div class="empty"></div>
        </td>
      </tr>
    @endif
    </tbody>
  </table>
@stop
