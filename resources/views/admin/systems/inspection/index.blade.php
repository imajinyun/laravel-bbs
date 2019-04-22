@extends('admin.layouts.app')

@section('title', '系统管理')

@section('sidebar')
  @php($sidebar = 'system')
@endsection

@section('content')
  <table class="table table-striped table-bordered">
    <thead>
    <tr>
      <th width="40%">环境检测</th>
      <th width="20%">推荐配置</th>
      <th width="20%">当前状态</th>
      <th width="20%">最低要求</th>
    </tr>
    </thead>
    <tbody>
    @if (count($data['environment']))
      @foreach($data['environment'] as $environment)
        <tr>
          <td>
            {{ $environment['name'] }}
            @if (isset($environment['href']))
              【<a href="{{ route($environment['href']) }}" target="_blank">更多信息</a>】
            @endif
          </td>
          <td>{{ $environment['recommend'] }}</td>
          <td>{{ $environment['current'] }}</td>
          <td>{{ $environment['lowest'] }}</td>
        </tr>
      @endforeach
    @endif
    </tbody>
  </table>

  <table class="table table-hover table-striped table-bordered">
    <thead>
    <tr>
      <th width="60%">通信情况</th>
      <th width="40%">状态</th>
    </tr>
    </thead>
    <tbody>
    <tr></tr>
    </tbody>
  </table>

  <div style="overflow:auto;max-height:400px;word-break:break-all;">
    <table class="table table-hover table-striped table-bordered" id="direcory-check-table"
           data-url="">
      <thead>
      <tr>
        <th width="60%">系统文件、目录权限检查</th>
        <th width="20%">当前状态</th>
        <th width="20%">所需状态</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td colspan="6" style="text-align: center;color: #c1c1c1;padding: 50px;">文件目录权限正常</td>
      </tr>
      </tbody>
    </table>
  </div>

  <div style="overflow:auto;max-height:400px;word-break:break-all;">
    <table class="table table-hover table-striped table-bordered" id="direcory-check-table"
           data-url="">
      <thead>
      <tr>
        <th width="30%">系统空间占用</th>
        <th width="20%">可用</th>
        <th width="25%">总共</th>
        <th width="25%">剩余</th>
      </tr>
      </thead>
      <tbody>
      @if (count($data['utilization']))
        @foreach ($data['utilization'] as $utilization)
          <tr>
            <td>
              {{ $utilization['name'] }}
              <a class="glyphicon glyphicon-question-sign text-muted pull-center" data-toggle="popover"
                 data-trigger="hover"
                 data-placement="top" data-content="用户在站点进行操作的日志存放目录" data-original-title="" title="">
              </a>
            </td>
            <td>{{ $utilization['free'] }}</td>
            <td>{{ $utilization['total'] }}</td>
            <td>{{ $utilization['rate'] }}</td>
          </tr>
        @endforeach
      @endif
      </tbody>
    </table>
  </div>
@stop
