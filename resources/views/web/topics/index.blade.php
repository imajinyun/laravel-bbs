@extends('web.layouts.app')

@section('title', isset($category) ? $category->name : '话题列表')

@section('content')
<div class="row mb-5">
    @if (isset($category))
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="alert alert-info" role="alert">
            {{ $category->name }}：{{ $category->description }}
        </div>
    </div>
    @endif
    <div class="col-lg-9 col-md-9 topic-list">
        <div class="card">
            <div class="card-header bg-transparent">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a href="{{ Request::url() }}?order=default"
                            class="nav-link {{ active_class(! if_query('order', 'recent')) }}">最后回复</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Request::url() }}?order=recent"
                            class="nav-link {{ active_class(if_query('order', 'recent')) }}">最新发布</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                {{-- 主题列表 --}}
                @include('web.topics.partials.topics', ['topics' => $topics])

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
