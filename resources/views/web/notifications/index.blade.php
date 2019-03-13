@extends('web.layouts.app')

@section('title', '我的通知')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="card">

          <div class="card-body">
            <h3 class="text-xs-center">
              <i class="fa fa-bell"></i> 我的通知
            </h3>
            <hr>

            @if ($notifications->count())
              <div class="list-unstyled notification-list">
                @foreach($notifications as $notification)
                  @include('web.notifications.partials.' . snake_case(class_basename($notification->type)))
                @endforeach
                {!! $notifications->render() !!}
              </div>
            @else
              <div class="alert alert-warning" role="alert">暂无数据 ~_~</div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
