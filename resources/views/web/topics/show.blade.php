@extends('web.layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')
  <div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">作者：{{ $topic->user->name }}</div>
          <hr>
          <div class="media">
            <div align="center">
              <a href="{{ route('users.show', $topic->user->id) }}">
                <img class="thumbnail img-fluid" src="{{ $topic->user->avatar }}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card">
      </div>
    </div>

    {{-- 用户回复列表 --}}
    <div class="card topic-reply mt-4">
    </div>
  </div>
@stop
