@extends('web.layouts.app')

@section('title', $user->name . ' - 个人中心')

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <div class="card ">
        <img class="card-img-top img-thumbnail" src="{{ cdn_aliyun($user->avatar) }}" alt="{{ $user->name }}">
        <div class="card-body">
          <h5><strong>个人简介</strong></h5>
          <p>{{ $user->introduction }}</p>
          <hr>
          <h5><strong>注册于</strong></h5>
          <p>{{ $user->created_at->diffForHumans() }}</p>
          <hr>
          <h5><strong>最后活跃于</strong></h5>
          <p>{{ $user->last_actived_at->diffForHumans() }}</p>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="card ">
        <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }}
            <small>{{ $user->email }}</small>
          </h1>
        </div>
      </div>
      <hr>

      {{-- 用户发布的内容 --}}
      <div class="card ">
        <div class="card-body">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}"
                 href="{{ route('users.show', $user->id) }}">Ta 的话题</a>
            </li>
            <li class="nav-item">
              <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}"
                 href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Ta 的回复</a>
            </li>
          </ul>

          @if (if_query('tab', 'replies'))
            @include('web.users.partials.replies', [
              'replies' => $user->replies()->with('topic')->withUpdatedAt('desc')->paginate(8)
            ])
          @else
            @include('web.users.partials.topics', [
              'topics' => $user->topics()->withUpdatedAt('desc')->paginate(8)
            ])
          @endif
        </div>
      </div>
    </div>
  </div>
@stop
