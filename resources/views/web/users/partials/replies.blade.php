{{-- 用户回复列表 --}}
@if (count($replies))
  <ul class="list-group mt-4 border-0">
    @foreach ($replies as $reply)
      <li class="list-group-item pl-2 pr-2 border-left-0 border-right-0
          @if ($loop->first) border-top-0 @endif"
      >
        <a href="{{ $reply->topic->link(['#reply' . $reply->id]) }}">
          {{ $reply->topic->title }}
        </a>
        <div class="reply-content mt-2 mb-2">{!! $reply->content !!}</div>
        <div class="text-secondary" style="font-size: 0.9em;">
          <i class="fa fa-clock"></i> 回复于 {{ $reply->created_at->diffForHumans() }}
        </div>
      </li>
    @endforeach
  </ul>
@else
  <div class="alert alert-info" role="alert">暂无数据 ~_~</div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
  {!! $replies->appends(Request::except('page'))->render() !!}
</div>
