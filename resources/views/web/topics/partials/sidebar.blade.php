<div class="card">
  <div class="card-body">
    <a class="btn btn-success btn-block" href="{{ route('topics.create') }}" aria-label="Left Align">
      <i class="fa fa-pencil mr-2"></i> 新建帖子
    </a>
  </div>
</div>

@if (count($users))
  <div class="card sidebar">
    <div class="card-header ">
      <div class="text-center">活跃用户</div>
    </div>
    <div class="card-body card-media">
      @foreach ($users as $user)
        <div class="media">
          <div class="media-left">
            <a href="{{ route('users.show', $user->id) }}">
              <img src="{{ $user->avatar }}" class="rounded-circle" width="24px" height="24px" alt="">
            </a>
          </div>
          <div class="media-body">
            <div class="media-heading mb-2 ml-2">
              <a href="" title="">{{ $user->name }}</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif

@if (count($links))
  <div class="card sidebar">
    <div class="card-header">
      <div class="text-center">推荐链接</div>
    </div>
    <div class="card-body card-media">
      @foreach($links as $link)
        <div class="media">
          <div class="media-body">
            <div class="media-heading mb-2">
              <a href="{{ $link->href }}" target="_blank">{{ str_limit($link->name, 26) }}</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif
