<ul class="list-unstyled">
  @foreach($replies as $index => $reply)
    <li class="media">
      <a href="{{ route('users.show', [$reply->user_id]) }}">
        <img src="{{ cdn_aliyun($reply->user->avatar) }}" title="{{ $reply->user->name }}"
             alt="{{ $reply->user->name }}" class="mr-3 img-thumbnail"
             style="width: 48px; height: 48px;">
      </a>
      <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
          <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
            <i class="fa fa-user"></i> {{ $reply->user->name }}
          </a>
          <span class="text-secondary">&nbsp;•&nbsp;</span>
          <span title="最后活跃于" class="text-secondary timeago">
            <i class="fa fa-clock"></i> {{ $reply->created_at->diffForHumans() }}
          </span>

          {{-- 回复评论删除按钮 --}}
          @can('destroy', $reply)
            <form action="{{ route('replies.destroy', $reply->id) }}" method="POST"
                  accept-charset="UTF-8" style="display: inline;"
                  onsubmit="return confirm('你确定要删除此条评论？')"
            >
              @csrf
              @method('DELETE')
              <span class="meta float-right">
                <button type="submit" class="btn btn-outline-danger btn-sm">
                  <i class="fa fa-trash"></i>
                </button>
              </span>
            </form>
          @endcan
        </div>
        <div class="reply-content text-secondary">{!! $reply->content !!}</div>
      </div>
    </li>

    @if (! $loop->last)
      <hr>
    @endif
  @endforeach
</ul>
