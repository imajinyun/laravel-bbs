@if($topics->count())
  <ul class="list-unstyled">
    @foreach($topics as $topic)
      <li class="media">
        <div class="media-left">
          <a href="{{ route('users.show', [$topic->user_id]) }}">
            <img class="mr-3 img-thumbnail" src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}"
                 style="width: 52px; height: 52px;" alt="{{ $topic->user->name }}">
          </a>
        </div>
        <div class="media-body">
          <div class="media-heading mt-0 mb-1">
            <a href="{{ route('categories.show', [$topic->category_id]) }}"
               title="{{ $topic->title }}">{{ $topic->title }}</a>
            <a class="float-right" href="#">
              <span class="badge badge-secondary badge-pill"> {{ $topic->reply_count }} </span>
            </a>
          </div>
          <div class="media-meta">
            <a href="{{ route('categories.show', [$topic->category_id]) }}" title="{{ $topic->category->name }}">
              <i class="fa fa-folder-open"></i> {{ $topic->category->name }}
            </a>
            <span>&nbsp;•&nbsp;</span>
            <a href="#" title="{{ $topic->user->name }}">
              <i class="fa fa-user"></i> {{ $topic->user->name }}
            </a>
            <span>&nbsp;•&nbsp;</span>
            <i class="fa fa-clock-o"></i>
            <span class="timeago" title="最后活跃于">{{ $topic->updated_at->diffForHumans() }}</span>
          </div>
        </div>
      </li>

      @if(! $loop->last)
        <hr>
      @endif
    @endforeach
  </ul>
@else
  <div class="alert alert-warning" role="alert">暂无数据 ~_~</div>
@endif
