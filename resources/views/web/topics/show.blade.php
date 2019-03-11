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
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">{{ $topic->title }}</h1>
          <div class="text-center text-secondary">
            <i class="fa fa-clock"></i> {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="fa fa-comment"></i> {{ $topic->reply_count }}
          </div>
        </div>

        <div class="card-body topic-body mt-4 mb-4">{!! $topic->body !!}</div>
        <div class="dropdown-divider"></div>
        <div class="card-body">
          <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-primary btn-sm" role="button">
            <i class="fa fa-edit"></i> 编辑
          </a>
          <form action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm" type="submit">
              <i class="fa fa-trash-alt"></i> 删除
            </button>
          </form>
        </div>
      </div>
    </div>

    {{-- 用户回复列表 --}}
    <div class="card topic-reply mt-4">
      <div class="card-body">
        <div class="row reply-list">
          <div></div>
        </div>
      </div>
    </div>
  </div>
@stop
