@extends('admin.layouts.app')

@section('title', '系统管理')

@section('sidebar')
  @php($sidebar = 'system')
@stop

@section('content')

  @if ($outputs)
    <div id="command-list">
<pre>
<i class="fa fa-times close-output"> 清除输出</i>
<span class="text-success">Artisan Command Output:</span>
{{ trim(trim($outputs), '"') }}
</pre>
    </div>
  @endif

  @if (count($commands))
    @foreach($commands as $key => $command)
      <div class="panel panel-default col-md-5 col-lg-5 artisan-command">
        <div class="panel-heading">
          <h3 class="panel-title">{{ $command->name }}</h3>
        </div>
        <div class="panel-body">
          <code>php artisan {{ $command->name }}</code>
          <br>
          <small>{{ $command->description }}</small>

          <div style="margin-top: 4px">
            <form class="form-inline" method="POST" accept-charset="UTF-8"
                  action="{{ route('admin.systems.artisans.output') }}">
              @csrf
              <div class="form-group">
                <input type="text" class="form-control" name="args" id="args" placeholder="请输入命令参数">
                <input type="submit" class="btn btn-primary" value="运行命令">
              </div>
              <input type="hidden" name="name" id="name" value="{{ $command->name }}">
            </form>
          </div>
        </div>
      </div>
    @endforeach
  @endif

@stop
