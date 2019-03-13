<div class="reply-box">
  <form action="{{ route('replies.store') }}" method="POST" accept-charset="UTF-8">
    @csrf
    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
    <div class="form-group">
      <textarea class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}"
                name="content" rows="3" placeholder="分享你的想法"></textarea>

      @if ($errors->has('content'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('content') }}</strong>
        </span>
      @endif
    </div>
    <button type="submit" class="btn btn-outline-primary">
      <i class="fa fa-share"></i> 回复
    </button>
  </form>
</div>
<hr>
