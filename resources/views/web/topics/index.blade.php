@extends('web.layouts.app')

@section('title',  '话题列表')

@section('content')
  <div class="row mb-5">
    <div class="col-lg-9 col-md-9 topic-list">
      <div class="card">
        <div class="card-header bg-transparent">
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a href="#" class="nav-link active">最后回复</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">最新发布</a>
            </li>
          </ul>
        </div>

        <div class="card-body">
          {{-- 主题列表 --}}
          @include('web.topics.partials.list', ['topics' => $topics])

          {{-- 分页 --}}
          <div class="mt-5">
            {!! $topics->appends(Request::except('page'))->render() !!}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 sidebar">
      @include('web.topics.partials.sidebar')
    </div>
  </div>
@endsection
